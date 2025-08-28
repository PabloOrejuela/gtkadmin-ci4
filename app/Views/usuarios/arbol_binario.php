<!-- View: usuarios/arbol_binario -->
<link rel="stylesheet" href="<?= site_url(); ?>public/css/arbol-binario.css">
<script src="https://d3js.org/d3.v7.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="col-md-12">
    <svg width="100%" height="100%"></svg>

    <script>
    const data = <?php echo json_encode($treeData, JSON_UNESCAPED_UNICODE); ?>;
    const todosLosNodos = <?php echo json_encode(array_values($todosLosSocios), JSON_UNESCAPED_UNICODE); ?>;

    // --- Construir árbol binario ---
    function construirArbol(nodo, todos) {
        nodo.children = [];

        // Filtra hijos según el id del nodo padre
        let hijos = todos.filter(h => String(h.nodopadre) === String(nodo.id));

        // Ubicación según posicion: 1 = izquierda, 2 = derecha
        let izq = hijos.find(h => h.posicion == 1) || null;
        let der = hijos.find(h => h.posicion == 2) || null;

        // Agrega hijos o nodos vacíos
        nodo.children.push(izq ? {...izq} : { empty: true, name: "", posicion: 1, id: null });
        nodo.children.push(der ? {...der} : { empty: true, name: "", posicion: 2, id: null });

        // Recursión solo en hijos reales
        if (izq) construirArbol(izq, todos);
        if (der) construirArbol(der, todos);
    }


    construirArbol(data, todosLosNodos);
    const root = d3.hierarchy(data);

    // --- D3 SVG ---
    const svg = d3.select("svg"),
          width = window.innerWidth,
          height = window.innerHeight;

    const g = svg.append("g").attr("transform", "translate(50,50)");

    const zoom = d3.zoom()
        .scaleExtent([0.5, 2])
        .on("zoom", (event) => g.attr("transform", event.transform));
    svg.call(zoom);

    const treeLayout = d3.tree().size([Math.max(600, root.children.length*200), height - 500]);
    treeLayout(root);

    // Enlaces
    g.selectAll(".link")
        .data(root.links())
        .enter()
        .append("path")
        .attr("class", "link")
        .attr("stroke", "#555")
        .attr("stroke-opacity", 0.5)
        .attr("fill", "none")
        .attr("d", d => {
            let vertical = d.source.depth === 0 ? 20 : 10;
            const y1 = d.source.y;
            const y2 = d.target.y - vertical;
            return `M${d.source.x},${y1} V${y2} H${d.target.x} V${d.target.y}`;
        });

    // Nodos
    const node = g.selectAll(".node")
        .data(root.descendants())
        .enter()
        .append("g")
        .attr("class", "node")
        .attr("transform", d => `translate(${d.x},${d.y})`)
        .on("click", (event, d) => {
            if (!d.data.empty) alertaMensaje('Aquí va la información', 1500, 'info');
        });

    node.append("rect")
        .attr("x", -75)
        .attr("y", 0)
        .attr("width", 150)
        .attr("height", 200)
        .attr("rx", 4)
        .attr("fill", d => d.data.empty ? "transparent" : "#e6e9d0")
        .attr("stroke", d => d.data.empty ? "none" : "#2E7D32")
        .attr("stroke-width", d => d.data.empty ? 0 : 2);

    node.append("text")
        .attr("x", 0)
        .attr("dy", 55)
        .attr("text-anchor", "middle")
        .attr("dominant-baseline", "middle")
        .attr("fill", d => d.data.empty ? "transparent" : "#000")
        .style("font-family", "Arial, sans-serif")
        .style("font-weight", d => d.data.empty ? "normal" : "bold")
        .style("font-size", "11px")
        .text(d => d.data.nombre);

    node.filter(d => !d.data.empty).append("text")
        .attr("x", 0)
        .attr("dy", 75)
        .attr("text-anchor", "middle")
        .attr("dominant-baseline", "middle")
        .attr("fill", "#000")
        .style("font-size", "10px")
        .text(d => "Rango: " + d.data.rango);

    node.filter(d => !d.data.empty).append("text")
        .attr("x", 0)
        .attr("dy", 95)
        .attr("text-anchor", "middle")
        .attr("dominant-baseline", "middle")
        .attr("fill", "#000")
        .style("font-size", "10px")
        .text(d => "COD: " + d.data.codigo_socio);

    const alertaMensaje = (msg, time, icon) => {
        const toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: time,
            didOpen: (toast) => { toast.onmouseenter = Swal.stopTimer; toast.onmouseleave = Swal.resumeTimer; },
            customClass: { popup: 'popup-class' }
        });
        toast.fire({ position: "top-end", icon: icon, title: msg });
    }
    </script>
</div>