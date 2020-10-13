<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lineas
 *
 * @ORM\Table(name="lineas")
 * @ORM\Entity
 */
class Lineas
{
    /**
     * @var string
     *
     * @ORM\Column(name="linea", type="string", length=100, nullable=false)
     */
    private $linea;

    /**
     * @var string
     *
     * @ORM\Column(name="icono", type="string", length=20, nullable=false)
     */
    private $icono;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



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
     * @return string
     */
    public function getIcono()
    {
        return $this->icono;
    }

    /**
     * @param string $icono
     *
     * @return self
     */
    public function setIcono($icono)
    {
        $this->icono = $icono;

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

