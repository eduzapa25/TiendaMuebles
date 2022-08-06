<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Model\Repository\ArticulosRepository")
 * @ORM\Table(name="articulos")
 */
class Articulos
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="idArticulo", type="integer")
     */
    private $idArticulo;

    /**
     * @ORM\Column(name="nombre", type="string", nullable=false)
     */    
    private $nombre;

    /**
     * @ORM\Column(name="tipo", type="string", nullable=false)
     */    
    private $tipo;

    /**
     * @ORM\Column(name="color", type="string", nullable=false)
     */
    private $color;

    /**
     * @ORM\Column(name="madera", type="string", nullable=false)
     */
    private $madera;

    /**
     * @ORM\Column(name="precio", type="float", nullable=false)
     */
    private $precio;

    /**
     * @ORM\Column(name="precioAlquiler", type="float")
     */
    private $precioAlquiler;
    
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

    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

    }

    /**
     * Get the value of tipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

    }

    /**
     * Get the value of color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @return  self
     */
    public function setColor($color)
    {
        $this->color = $color;

    }

    /**
     * Get the value of madera
     */
    public function getMadera()
    {
        return $this->madera;
    }

    /**
     * Set the value of madera
     *
     * @return  self
     */
    public function setMadera($madera)
    {
        $this->madera = $madera;

    }


    

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of precioAlquiler
     */ 
    public function getPrecioAlquiler()
    {
        return $this->precioAlquiler;
    }

    /**
     * Set the value of precioAlquiler
     *
     * @return  self
     */ 
    public function setPrecioAlquiler($precioAlquiler)
    {
        $this->precioAlquiler = $precioAlquiler;

        return $this;
    }
}