<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Model\Repository\UsuarioRepository")
 * @ORM\Table(name="usuarios")
 */
class Usuario
{
    /**
     * @ORM\Id()
     * @ORM\Column(name="dni", type="string", nullable=false)
     */
    private $DNI;

    /**
     * @ORM\Column(name="nombre", type="string", nullable=false)
     */    
    private $nombre;

    /**
     * @ORM\Column(name="apellido", type="string", nullable=false)
     */    
    private $apellido;

    /**
     * @ORM\Column(name="email", type="string", nullable=false)
     */
    private $email;

    /**
     * @ORM\Column(name="password", type="string", nullable=false)
     */
    private $password;
    /**
     * @ORM\Column(name="rol", type="string")
     */
    private $rol;

    /**
     * @ORM\Column(name="tarjeta", type="string")
     */
    private $tarjeta;

    /**
     * @ORM\Column(name="telefono", type="string")
     */
    private $telefono;

    /**
     * @ORM\Column(name="direccion", type="string")
     */
    private $direccion;
    

    
    public function __construct()
    {
    }    

    

    /**
     * Get the value of DNI
     */ 
    public function getDNI()
    {
        return $this->DNI;
    }

    /**
     * Set the value of DNI
     *
     * @return  self
     */ 
    public function setDNI($DNI)
    {
        $this->DNI = $DNI;

        return $this;
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

        return $this;
    }

    /**
     * Get the value of apellido
     */ 
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set the value of apellido
     *
     * @return  self
     */ 
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of rol
     */ 
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of rol
     *
     * @return  self
     */ 
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get the value of tarjeta
     */ 
    public function getTarjeta()
    {
        return $this->tarjeta;
    }

    /**
     * Set the value of tarjeta
     *
     * @return  self
     */ 
    public function setTarjeta($tarjeta)
    {
        $this->tarjeta = $tarjeta;

        return $this;
    }

    /**
     * Get the value of telefono
     */ 
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set the value of telefono
     *
     * @return  self
     */ 
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get the value of direccion
     */ 
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */ 
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }
}