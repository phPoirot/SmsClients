<?php
namespace Poirot\Sms\Interfaces;

/**
 * Length of standard Message with Characters include:
 *   unicode(‫‪UCS2)‬  is 70  chrs.
 *   ascii(DEFAULT) is 160 chrs.
 *   binary(‫‪DATA_8) is 140 byte
 *
 * in messages with longer length
 *   unicode 3 chrs. assign to UDH message header
 *   ascii   7 chrs.
 *
 */
interface iMessage
{
    /*
     * ++ Message Coding ++
     */
    const CODING_ISO     = 'ASCII';
    const CODING_UNICODE = 'UCS2';
    const CODING_DATA8   = 'DATA_8';
    const CODING_BINARY  = 'BINARY';


    /**
     * Get Message Unique ID
     *
     * @return string|array
     */
    function getUid();

    /**
     * Get Message Body
     *
     * !! represent in encoding injected
     *
     * @return string
     */
    function getBody();


    /**
     * Get Created DateTime
     *
     * @return \DateTime
     */
    function getDateTimeCreated();


    /**
     * Set Message Coding
     *
     * @param string $coding
     *
     * @return $this
     */
    function setCoding($coding);

    /**
     * Get Coding
     *
     * @return string
     */
    function getCoding();

    /**
     * Set Message Type To Flash Message
     *
     * @param bool $bool
     *
     * @return $this
     */
    function setFlash($bool = true);

    /**
     * Is Flash Message?
     *
     * @return boolean
     */
    function isFlash();

}
