<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrdenesDetalle
 *
 * @ORM\Table(name="ordenes_detalle")
 * @ORM\Entity
 */
class OrdenesDetalle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="orden_id", type="integer", nullable=false)
     */
    private $ordenId;

    /**
     * @var string
     *
     * @ORM\Column(name="producto_id", type="string", length=15, nullable=false)
     */
    private $productoId;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * @return integer
     */
    public function getOrdenId()
    {
        return $this->ordenId;
    }

    /**
     * @param integer $ordenId
     *
     * @return self
     */
    public function setOrdenId($ordenId)
    {
        $this->ordenId = $ordenId;

        return $this;
    }

    /**
     * @return string
     */
    public function getProductoId()
    {
        return $this->productoId;
    }

    /**
     * @param string $productoId
     *
     * @return self
     */
    public function setProductoId($productoId)
    {
        $this->productoId = $productoId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}

