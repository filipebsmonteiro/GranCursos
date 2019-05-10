<?php

namespace EnderecoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Endereco
 *
 * @ORM\Table(name="endereco")
 * @ORM\Entity(repositoryClass="EnderecoBundle\Repository\EnderecoRepository")
 */
class Endereco
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="quadra", type="string", length=255)
     */
    private $quadra;

    /**
     * @var float
     *
     * @ORM\Column(name="numero", type="float")
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="observacao", type="string", length=255)
     */
    private $observacao;

    /**
     * @var int
     *
     * @ORM\Column(name="Contato_idContato", type="integer")
     */
    private $contatoIdContato;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quadra
     *
     * @param string $quadra
     *
     * @return Endereco
     */
    public function setQuadra($quadra)
    {
        $this->quadra = $quadra;

        return $this;
    }

    /**
     * Get quadra
     *
     * @return string
     */
    public function getQuadra()
    {
        return $this->quadra;
    }

    /**
     * Set numero
     *
     * @param float $numero
     *
     * @return Endereco
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return float
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set observacao
     *
     * @param string $observacao
     *
     * @return Endereco
     */
    public function setObservacao($observacao)
    {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * Get observacao
     *
     * @return string
     */
    public function getObservacao()
    {
        return $this->observacao;
    }

    /**
     * Set contatoIdContato
     *
     * @param integer $contatoIdContato
     *
     * @return Endereco
     */
    public function setContatoIdContato($contatoIdContato)
    {
        $this->contatoIdContato = $contatoIdContato;

        return $this;
    }

    /**
     * Get contatoIdContato
     *
     * @return int
     */
    public function getContatoIdContato()
    {
        return $this->contatoIdContato;
    }
}

