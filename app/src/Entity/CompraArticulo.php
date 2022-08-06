<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Model\Repository\CompraArticuloRepository")
 * @ORM\Table(name="compraarticulo")
 */
class CompraArticulo
{
    
    /**
     * @ORM\Id()
     * @ORM\Column(name="idCompra", type="integer", nullable=false)
     */    
    private $idCompra;

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
     * Get the value of idCompra
     */ 
    public function getIdCompra()
    {
        return $this->idCompra;
    }

    /**
     * Set the value of idCompra
     *
     * @return  self
     */ 
    public function setIdCompra($idCompra)
    {
        $this->idCompra = $idCompra;

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


    