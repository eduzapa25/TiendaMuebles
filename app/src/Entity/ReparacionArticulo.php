<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Model\Repository\ReparacionArticuloRepository")
 * @ORM\Table(name="reparacionarticulo")
 */
class ReparacionArticulo
{
    
    /**
     * @ORM\Id()
     * @ORM\Column(name="idReparacion", type="integer", nullable=false)
     */    
    private $idReparacion;

    /**
     * @ORM\Id()
     * @ORM\Column(name="tipoReparacion", type="string")
     */    
    private $tipoReparacion;

    /**
     * @ORM\OneToOne(targetEntity="Articulos")
     * @ORM\JoinColumn(name="idArticulo", referencedColumnName="idArticulo")
     */
    private $idArticulo;

    /**
     * @ORM\ManyToOne(targetEntity="Pedido")
     * @ORM\JoinColumn(name="idPedido", referencedColumnName="idPedido")
     */
    private $idPedido;
    

    public function __construct()
    {
    }

    


    /**
     * Get the value of idReparacion
     */ 
    public function getIdReparacion()
    {
        return $this->idReparacion;
    }

    /**
     * Set the value of idReparacion
     *
     * @return  self
     */ 
    public function setIdReparacion($idReparacion)
    {
        $this->idReparacion = $idReparacion;

        return $this;
    }

    /**
     * Get the value of tipoReparacion
     */ 
    public function getTipoReparacion()
    {
        return $this->tipoReparacion;
    }

    /**
     * Set the value of tipoReparacion
     *
     * @return  self
     */ 
    public function setTipoReparacion($tipoReparacion)
    {
        $this->tipoReparacion = $tipoReparacion;

        return $this;
    }

    /**
     * Get the value of idArticulo
     */ 
    public function getIdArticulo()
    {
        return $this->idArticulo;
    }

    /**
     * Set the value of idArticulo
     *
     * @return  self
     */ 
    public function setIdArticulo($idArticulo)
    {
        $this->idArticulo = $idArticulo;

        return $this;
    }

    /**
     * Get the value of idPedido
     */ 
    public function getIdPedido()
    {
        return $this->idPedido;
    }

    /**
     * Set the value of idPedido
     *
     * @return  self
     */ 
    public function setIdPedido($idPedido)
    {
        $this->idPedido = $idPedido;

        return $this;
    }
}    


    