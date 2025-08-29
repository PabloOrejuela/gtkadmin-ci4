<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\BilleteraDigitalModel;
use App\Models\BirModel;
use App\Models\CiudadModel;
use App\Models\HistRangoModel;
use App\Models\LiderModel;
use App\Models\PagoModel;
use App\Models\PaqueteModel;
use App\Models\PedidoModel;
use App\Models\ProvinciaModel;
use App\Models\PuntosRedModel;
use App\Models\RolModel;
use App\Models\RangoModel;
use App\Models\SistemaModel;
use App\Models\SocioModel;
use App\Models\UsuarioModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['form', 'url', 'html'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger){

        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->db = \Config\Database::connect();
        $this->billeteraDigitalModel = new BilleteraDigitalModel($this->db);
        $this->birModel = new BirModel($this->db);
        $this->ciudadModel = new CiudadModel($this->db);
        $this->histRangoModel = new HistRangoModel($this->db);
        $this->liderModel = new LiderModel($this->db);
        $this->pagoModel = new PagoModel($this->db);
        $this->paqueteModel = new PaqueteModel($this->db);
        $this->pedidoModel = new PedidoModel($this->db);
        $this->provinciaModel = new ProvinciaModel($this->db);
        $this->puntosRedModel = new PuntosRedModel($this->db);
        $this->rolModel = new RolModel($this->db);
        $this->rangoModel = new RangoModel($this->db);
        $this->sistemaModel = new SistemaModel($this->db);
        $this->socioModel = new SocioModel($this->db);
        $this->usuarioModel = new UsuarioModel($this->db);

        // E.g.: $this->session = service('session');
        $this->session = \Config\Services::session();
        $this->request = \Config\Services::request();
        $this->validation = \Config\Services::validation();
        $this->image = \Config\Services::image();
    }
}
