<?php
namespace Poirot\Sms;

use Poirot\Sms\Interfaces\iSentMessage;


class SMSentMessage
    extends SMSMessage
    implements iSentMessage
{
    protected $recipients = array();


    /**
     * Set Receivers of message
     *
     * @param array $recipients
     *
     * @return $this
     */
    function setRecipients(array $recipients)
    {
        $this->recipients = $recipients;
        return $this;
    }

    /**
     * Get Message Recipients
     *
     * @return []string
     */
    function getRecipients()
    {
        return $this->recipients;
    }


    // Implement Serializable

    /**
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    function serialize()
    {
        $values = array(
            'u' => $this->getUID(),
            'b' => $this->getBody(),
            'c' => $this->getCoding(),
            'f' => $this->isFlash(),
            'd' => $this->getCreatedDate(),
            'r' => $this->getRecipients(),
        );

        return json_encode($values);
    }

    /**
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    function unserialize($serialized)
    {
        $options = json_decode($serialized);
        $options = \Poirot\Std\toArrayObject($options);

        $date     = $options['d'];
        $dateTime = new \DateTime($date['date'], new \DateTimeZone($date['timezone']));

        $this->isFlash = $options['f'];
        $this->coding  = $options['c'];
        $this->uid     = $options['u'];
        $this->content = $options['b'];
        $this->recipients = $options['r'];
        $this->dateTimeCreated = $dateTime;
    }
}
