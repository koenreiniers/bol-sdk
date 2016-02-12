<?php
namespace Kr\Bol\Mapper;

use Kr\Bol\Utils\XmlParser;

class OrderMapper
{
    public function __construct()
    {
        $this->xmlParser = new XmlParser();
    }

    /**
     * Map xml string to more logical struct
     * @param string $xmlString
     */
    public function map($xmlString)
    {
        $array = $this->xmlParser->parse($xmlString);

        $mappedOrders = [];
        $orders = $array['bns:OpenOrders'];

        // 0 orders
        if(!isset($orders['bns:OpenOrder'])) {
            return [];
        }

        // > 1 orders
        $orders = $orders['bns:OpenOrder'];

        // One order
        if(isset($orders['bns:OrderId'])) {
            $orders = [$orders];
        }

        // Cleanup keys
        foreach($orders as $order) {
            $mappedOrders[] = $this->cleanupKeys($order);
        }

        // Cleanup order items
        foreach($mappedOrders as &$mappedOrder)
        {
            $mappedOrder['openOrderItems'] = $this->cleanupOrderItems($mappedOrder);
        }

        return $mappedOrders;
    }

    /**
     * @param $order
     * @return array
     */
    private function cleanupOrderItems($order)
    {
        $orderItems = $order['openOrderItems'];

        // 0 Order items
        if(!isset($orderItems['openOrderItem'])) {
            return [];
        }

        // > 1 Order items
        $orderItems = $orderItems['openOrderItem'];

        // Exactly one order item
        if(isset($orderItems['orderItemId'])) {
            $orderItems = [$orderItems];
        }

        return $orderItems;
    }

    /**
     * Remove bns: + lcfirst
     * Also: convert EAN to ean
     * @param string $uglyKey
     * @return string - The cleaned up key
     */
    private function cleanupKey($uglyKey)
    {
        if(strpos($uglyKey, "bns:") === false) {
            return $uglyKey;
        }

        $lessUglyKey = substr($uglyKey, 4);
        if($lessUglyKey == "EAN") {
            return "ean";
        }

        $cleanKey = lcfirst($lessUglyKey);
        return $cleanKey;
    }

    /**
     * Recursively cleanup Bol's order response (remove bns: + lcfirst)
     * @param $array
     * @return array
     */
    private function cleanupKeys($array)
    {
        $cleanedUp = [];
        foreach($array as $key => $value)
        {
            $cleanKey = $this->cleanupKey($key);
            $newValue = $value;
            if(is_array($newValue)) {
                $newValue = $this->cleanupKeys($newValue);
            }
            $cleanedUp[$cleanKey] = $newValue;
        }

        return $cleanedUp;
    }
}