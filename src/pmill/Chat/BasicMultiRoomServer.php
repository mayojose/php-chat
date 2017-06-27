<?php
namespace pmill\Chat;

use pmill\Chat\Interfaces\ConnectedClientInterface;
use Ratchet\ConnectionInterface;

class BasicMultiRoomServer extends AbstractMultiRoomServer
{

    protected function makeUserWelcomeMessage(ConnectedClientInterface $client, $timestamp)
    {
        return vsprintf('Добро пожаловать, %s!', array($client->getName()));
    }

    protected function makeUserConnectedMessage(ConnectedClientInterface $client, $timestamp)
    {
        return vsprintf('%s в сети', array($client->getName()));
    }

    protected function makeUserDisconnectedMessage(ConnectedClientInterface $client, $timestamp)
    {
        return vsprintf('%s не в сети', array($client->getName()));
    }

    protected function makeMessageReceivedMessage(ConnectedClientInterface $from, $message, $timestamp)
    {
        return $message;
    }

    protected function logMessageReceived(ConnectedClientInterface $from, $message, $timestamp)
    {
        /** save messages to a database, etc... */
    }

    protected function createClient(ConnectionInterface $conn, $name, $avatar)
    {
        $client = new ConnectedClient;
        $client->setResourceId($conn->resourceId);
        $client->setConnection($conn);
        $client->setName($name);
        $client->setAvatar($avatar);
        return $client;
    }

}
