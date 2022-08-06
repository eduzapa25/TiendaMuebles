<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Model\Repository\FacturaRepository")
 * @ORM\Table(name="facturas")
 */
class Factura
{
    
    /**
     * @ORM\Id()
     * @ORM\Column(name="idFactura", type="integer", nullable=false)
     */    
    private $idFactura;

    /**
     * @ORM\Column(name="importeTotal", type="float")
     */    
    private $importeTotal;

    /**
     * @ORM\OneToOne(targetEntity="Pedido", fetch="EAGER")
     * @ORM\JoinColumn(name="idPedido", referencedColumnName="idPedido")
     */
    private $idPedido;

    public function __construct()
    {
    }
    

    /**
     * Get the value of idFactura
     */ 
    public function getIdFactura()
    {
        return $this->idFactura;
    }

    /**
     * Set the value of idFactura
     *
     * @return  self
     */ 
    public function setIdFactura($idFactura)
    {
        $this->idFactura = $idFactura;

        return $this;
    }

    /**
     * Get the value of importeTotal
     */ 
    public function getImporteTotal()
    {
        return $this->importeTotal;
    }

    /**
     * Set the value of importeTotal
     *
     * @return  self
     */ 
    public function setImporteTotal($importeTotal)
    {
        $this->importeTotal = $importeTotal;

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


    