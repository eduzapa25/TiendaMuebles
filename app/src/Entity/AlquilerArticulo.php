<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Model\Repository\AlquilerArticuloRepository")
 * @ORM\Table(name="alquilerArticulo")
 */
class AlquilerArticulo
{
    
    /**
     * @ORM\Id()
     * @ORM\Column(name="idAlquiler", type="integer", nullable=false)
     */    
    private $idAlquiler;

    /**
     * @ORM\Column(name="fInicio", type="date")
     */    
    private $fInicio;

    /**
     * @ORM\Column(name="fFinal", type="date")
     */    
    private $fFinal;

    /**
     * @ORM\ManyToOne(targetEntity="Pedido", fetch="EAGER")
     * @ORM\JoinColumn(name="idPedido", referencedColumnName="idPedido")
     */
    private $idPedido;


    /**
     * @ORM\ManyToOne(targetEntity="Articulos", fetch="EAGER")
     * @ORM\JoinColumn(name="idArticulo", referencedColumnName="idArticulo")
     */
    private $idArticulo;

    /**
     * @ORM\Column(name="precioTotal", type="float")
     */    
    private $precioTotal;

    

    public function __construct()
    {
    }

    /**
     * Get the value of idAlquiler
     */ 
    public function getIdAlquiler()
    {
        return $this->idAlquiler;
    }

    /**
     * Set the value of idAlquiler
     *
     * @return  self
     */ 
    public function setIdAlquiler($idAlquiler)
    {
        $this->idAlquiler = $idAlquiler;

        return $this;
    }

    /**
     * Get the value of fInicio
     */ 
    public function getFInicio()
    {
        return $this->fInicio;
    }

    /**
     * Set the value of fInicio
     *
     * @return  self
     */ 
    public function setFInicio($fInicio)
    {
        $this->fInicio = $fInicio;

        return $this;
    }

    /**
     * Get the value of fFinal
     */ 
    public function getFFinal()
    {
        return $this->fFinal;
    }

    /**
     * Set the value of fFinal
     *
     * @return  self
     */ 
    public function setFFinal($fFinal)
    {
        $this->fFinal = $fFinal;

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
     * Get the value of precioTotal
     */ 
    public function getPrecioTotal()
    {
        return $this->precioTotal;
    }

    /**
     * Set the value of precioTotal
     *
     * @return  self
     */ 
    public function setPrecioTotal($precioTotal)
    {
        $this->precioTotal = $precioTotal;

        return $this;
    }
    }    


    