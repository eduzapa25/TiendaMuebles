<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Model\Repository\AlmacenRepository")
 * @ORM\Table(name="almacen")
 */
class Almacen
{
    /**
     * @ORM\Id()
     * @ORM\OneToOne(targetEntity="Articulos")
     * @ORM\JoinColumn(name="idArticulo", referencedColumnName="idArticulo")
     */
    private $idArticulo;

    /**
     * @ORM\Column(name="cantidad", type="integer", nullable=false)
     */    
    private $cantidad;

    

    public function __construct()
    {
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
     * Get the value of cantidad
     */ 
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set the value of cantidad
     *
     * @return  self
     */ 
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

}