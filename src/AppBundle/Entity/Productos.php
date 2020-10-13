<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Productos
 *
 * @ORM\Table(name="productos")
 * @ORM\Entity
 */
class Productos
{
    /**
     * @var string
     *
     * @ORM\Column(name="producto", type="string", length=70, nullable=false)
     */
    private $producto;

    /**
     * @var string
     *
     * @ORM\Column(name="linea", type="string", length=50, nullable=false)
     */
    private $linea;

    /**
     * @var integer
     *
     * @ORM\Column(name="linea_id", type="integer", nullable=false)
     */
    private $lineaId;

    /**
     * @var string
     *
     * @ORM\Column(name="proveedor", type="string", length=50, nullable=false)
     */
    private $proveedor;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="precio_compra", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $precioCompra;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=15)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codigo;



    /**
     * @return string
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * @param string $producto
     *
     * @return self
     */
    public function setProducto($producto)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * @return string
     */
    public function getLinea()
    {
        return $this->linea;
    }

    /**
     * @param string $linea
     *
     * @return self
     */
    public function setLinea($linea)
    {
        $this->linea = $linea;

        return $this;
    }

    /**
     * @return integer
     */
    public function getLineaId()
    {
        return $this->lineaId;
    }

    /**
     * @param integer $lineaId
     *
     * @return self
     */
    public function setLineaId($lineaId)
    {
        $this->lineaId = $lineaId;

        return $this;
    }

    /**
     * @return string
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * @param string $proveedor
     *
     * @return self
     */
    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     *
     * @return self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrecioCompra()
    {
        return $this->precioCompra;
    }

    /**
     * @param string $precioCompra
     *
     * @return self
     */
    public function setPrecioCompra($precioCompra)
    {
        $this->precioCompra = $precioCompra;

        return $this;
    }

    /**
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param string $codigo
     *
     * @return self
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }
}

