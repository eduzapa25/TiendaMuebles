<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Model\Repository\PedidoRepository")
 * @ORM\Table(name="pedidos")
 */
class Pedido
{
    
    /**
     * @ORM\Id()
     * @ORM\Column(name="idPedido", type="integer", nullable=false)
     */    
    private $idPedido;

    /**
     * @ORM\Column(name="fecha", type="date")
     */    
    private $fecha;
    /**
     * @ORM\ManyToOne(targetEntity="Usuario", fetch="EAGER")
     * @ORM\JoinColumn(name="DNI_pedido", referencedColumnName="dni")
     */
    private $DNI_pedido;


    

    public function __construct()
    {
    }


    /**
     * Get the value of idPedidos
     */ 
    public function getIdPedido()
    {
        return $this->idPedido;
    }

    /**
     * Set the value of idPedidos
     *
     * @return  self
     */ 
    public function setIdPedido($idPedido)
    {
        $this->idPedido = $idPedido;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of DNI_pedido
     */ 
    public function getDNI_pedido()
    {
        return $this->DNI_pedido;
    }

    /**
     * Set the value of DNI_pedido
     *
     * @return  self
     */ 
    public function setDNI_pedido($DNI_pedido)
    {
        $this->DNI_pedido = $DNI_pedido;

        return $this;
    }
    
}