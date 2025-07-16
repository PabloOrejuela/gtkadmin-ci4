<link rel="stylesheet" href="<?= site_url(); ?>public/css/arbol-binario.css">
<script src="https://d3js.org/d3.v7.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="col-md-12">
    <svg></svg>

    <script>
        // Inyectamos los datos desde PHP como JSON
        const data = <?php echo json_encode($treeData, JSON_UNESCAPED_UNICODE); ?>;

        const svg = d3.select("svg"),
              width = window.innerWidth,
              height = window.innerHeight;

        const g = svg.append("g").attr("transform", "translate(50,50)");

        // Zoom y pan
        const zoom = d3.zoom()
            .scaleExtent([0.5, 2])
            .on("zoom", (event) => {
                g.attr("transform", event.transform);
            });

        svg.call(zoom);

        const root = d3.hierarchy(data);
        const hijos = root.children ? root.children.length : 1;

        // Define un ancho mínimo y un factor de expansión por hijo
        const minWidth = 600;
        const widthPorHijo = 200;

        // Calcula el ancho dinámico
        const dynamicWidth = Math.max(minWidth, hijos * widthPorHijo);

        // Usa el ancho dinámico en el layout
        const treeLayout = d3.tree().size([dynamicWidth, height - 500]);

        treeLayout(root);

        // Enlaces entre nodos
        g.selectAll(".link")
            .data(root.links())
            .enter()
            .append("path")
            .attr("class", "link")
            .attr("d", d => {
                
                // Línea: vertical corta, luego horizontal, luego vertical corta
                let vertical = d.source.depth === 0 ? 20 : 10; // longitud de la línea vertical
                const y1 = d.source.y;
                const y2 = d.target.y - vertical;
                return `
                    M${d.source.x},${y1}
                    V${y2}
                    H${d.target.x}
                    V${d.target.y}
                `;
            });

        // Nodos
        const node = g.selectAll(".node")
            .data(root.descendants())
            .enter()
            .append("g")
            .attr("class", "node")
            .attr("transform", d => `translate(${d.x},${d.y})`)
            .on("click", function(event, d) {
                alertaMensaje('Aquí va la información', 1500, 'info')
            });

        node.append("rect")
            .attr("x", -75)
            .attr("y", 0)
            .attr("width", 150)
            .attr("height", 200)
            .attr("rx", 4) // opcional: esquinas redondeadas, quítalo si quieres esquinas rectas
            .attr("fill", "#e6e9d0")
            .attr("stroke", "#2E7D32")
            .attr("stroke-width",2);
        
        //Nombre
        node.append("text")
            .attr("x", -25)
            .attr("dy", 55) // Centrado verticalmente dentro del rectángulo (10 + 80/2)
            .attr("text-anchor", "middle")
            .attr("dominant-baseline", "middle")
            .attr("fill", "#fff") // Opcional: texto blanco para mejor contraste
            .style("font-family", "Arial, sans-serif")
            .style("font-weight", "Bold")  // Cambia el tipo de fuente
            .style("font-size", "11px")   
            .style("text-align", "center")  
            .text(d => d.data.name).attr("x", 0);

        //Rango
        node.append("text")
            .attr("x", -25)
            .attr("dy", 75) // Centrado verticalmente dentro del rectángulo (10 + 80/2)
            .attr("text-anchor", "middle")
            .attr("dominant-baseline", "middle")
            .attr("fill", "#fff") // Opcional: texto blanco para mejor contraste
            .style("font-family", "Arial, sans-serif")
            .style("font-size", "10px")   
            .style("text-align", "center")  
            .text(d => "Rango: "+d.data.rango).attr("x", 0);
        
        //Código
        node.append("text")
            .attr("x", -25)
            .attr("dy", 95) // Centrado verticalmente dentro del rectángulo (10 + 80/2)
            .attr("text-anchor", "middle")
            .attr("dominant-baseline", "middle")
            .attr("fill", "#fff") // Opcional: texto blanco para mejor contraste
            .style("font-family", "Arial, sans-serif")
            .style("font-size", "10px")   
            .style("text-align", "center")  
            .text(d => "COD: "+d.data.codigo_socio).attr("x", 0);
        
        //Patrocinador
        node.append("text")
            .attr("x", -25)
            .attr("dy", 115) // Centrado verticalmente dentro del rectángulo (10 + 80/2)
            .attr("text-anchor", "middle")
            .attr("dominant-baseline", "middle")
            .attr("fill", "#fff") // Opcional: texto blanco para mejor contraste
            .style("font-family", "Arial, sans-serif")
            .style("font-size", "10px")   
            .style("text-align", "center")  
            .text(d => "Patrocinador: "+d.data.patrocinador).attr("x", 0);
        
        //Nodo padre
        node.append("text")
            .attr("x", -25)
            .attr("dy", 135) // Centrado verticalmente dentro del rectángulo (10 + 80/2)
            .attr("text-anchor", "middle")
            .attr("dominant-baseline", "middle")
            .attr("fill", "#fff") // Opcional: texto blanco para mejor contraste
            .style("font-family", "Arial, sans-serif")
            .style("font-size", "10px")   
            .style("text-align", "center")  
            .text(d => "Padre: "+d.data.patrocinador).attr("x", 0);

        const alertaMensaje = (msg, time, icon) => {
        const toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: time,
            //timerProgressBar: true,
            //height: '200rem',
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            },
            customClass: {
                // container: '...',
                popup: 'popup-class',
            }
        });
        toast.fire({
            position: "top-end",
            icon: icon,
            title: msg,
        });
    }
    </script>
</div>
