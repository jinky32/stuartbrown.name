<?php
/**
 * Created by PhpStorm.
 * User: stuartbrown
 * Date: 15/10/2015
 * Time: 07:44
 */

class Coverage {

    private $postcode;
    private $threeg_headline;
    private $threeg_bodytext;
    private $fourg_headline;
    private $fourg_bodytext;
    private $devicespeed_postcode;
    private $devicespeed_speed;



    //todo is there a way to pass the Guzzle response object to the constructor rather than the json decoded array
    function __construct(Psr\Http\Message\ResponseInterface $response)
    {
        $array = json_decode($response->getBody()->getContents(), true);
        $this->setPostcode($array['locationValue']);
        $this->setThreegHeadline($array['threeg']['headline']);
        $this->setThreegBodytext($array['threeg']['bodytext']);
        $this->setFourgHeadline($array['fourg']['headline']);
        $this->setFourgBodytext($array['fourg']['bodytext']);
        $this->setDevicespeedPostcode($array['devicespeed']['postcode']);
        $this->setDevicespeedSpeed($array['devicespeed']['speed']);


    }
    /**
     * @return mixed
     */
    public function getThreegBodytext()
    {
        return $this->threeg_bodytext;
    }

    /**
     * @param mixed $threeg_bodytext
     */
    public function setThreegBodytext($threeg_bodytext)
    {
        $this->threeg_bodytext = $threeg_bodytext;
    }

    /**
     * @return mixed
     */
    public function getFourgHeadline()
    {
        return $this->fourg_headline;
    }

    /**
     * @param mixed $fourg_headline
     */
    public function setFourgHeadline($fourg_headline)
    {
        $this->fourg_headline = $fourg_headline;
    }

    /**
     * @return mixed
     */
    public function getFourgBodytext()
    {
        return $this->fourg_bodytext;
    }

    /**
     * @param mixed $fourg_bodytext
     */
    public function setFourgBodytext($fourg_bodytext)
    {
        $this->fourg_bodytext = $fourg_bodytext;
    }

    /**
     * @return mixed
     */
    public function getDevicespeedPostcode()
    {
        return $this->devicespeed_postcode;
    }

    /**
     * @param mixed $devicespeed_postcode
     */
    public function setDevicespeedPostcode($devicespeed_postcode)
    {
        $this->devicespeed_postcode = $devicespeed_postcode;
    }

    /**
     * @return mixed
     */
    public function getDevicespeedSpeed()
    {
        return $this->devicespeed_speed;
    }

    /**
     * @param mixed $devicespeed_speed
     */
    public function setDevicespeedSpeed($devicespeed_speed)
    {
        $this->devicespeed_speed = $devicespeed_speed;
    }


    /**
     * @return mixed
     */
    public function getThreegHeadline()
    {
        return $this->threeg_headline;
    }

    /**
     * @param mixed $threeg_headline
     */
    public function setThreegHeadline($threeg_headline)
    {
        $this->threeg_headline = $threeg_headline;
    }

    /**
     * @return mixed
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param mixed $postcode
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }




}