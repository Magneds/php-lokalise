<?php // Copyright ⓒ 2018 Magneds IP B.V. - All Rights Reserved
namespace Magneds\Lokalise\Language\Entity;

class Language
{
    /**
     * @var string
     */
    protected $iso;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var boolean
     */
    protected $rtl;

    /**
     * Language constructor.
     * @param string $iso
     * @param string $name
     * @param bool $rtl
     */
    public function __construct(string $iso, string $name, bool $rtl)
    {
        $this->iso  = $iso;
        $this->name = $name;
        $this->rtl  = $rtl;
    }

    /**
     * @return string
     */
    public function getIso(): string
    {
        return $this->iso;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isRtl()
    {
        return $this->rtl;
    }
}
