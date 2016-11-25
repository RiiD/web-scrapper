<?php

namespace Slidely\Model;

class AmazonProductResponse implements \JsonSerializable {
    private $keyword;
    private $name;
    private $rating;
    private $fullPrice;
    private $lastPrice;

    public function __construct(string $keyword) {
        $this->keyword = $keyword;
    }

    /**
     * @return string
     */
    public function getKeyword(): string {
        return $this->keyword;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name) {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getRating(): float {
        return $this->rating;
    }

    /**
     * @param float $rating
     */
    public function setRating(float $rating) {
        $this->rating = $rating;
    }

    /**
     * @return float
     */
    public function getFullPrice(): float {
        return $this->fullPrice;
    }

    /**
     * @param float $fullPrice
     */
    public function setFullPrice(float $fullPrice) {
        $this->fullPrice = $fullPrice;
    }

    /**
     * @return float
     */
    public function getLastPrice(): float {
        return $this->lastPrice;
    }

    /**
     * @param float $lastPrice
     */
    public function setLastPrice(float $lastPrice) {
        $this->lastPrice = $lastPrice;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *        which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize() {
        return [
            'name' => $this->getName(),
            'rating' => $this->getRating(),
            'full_price' => $this->getFullPrice(),
            'last_price' => $this->getLastPrice(),
            'keyword' => $this->getKeyword()
        ];
    }
}