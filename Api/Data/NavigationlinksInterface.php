<?php
namespace Jaagers\Sortnavigationlinks\Api\Data;

interface NavigationlinksInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ENTITY_ID      = 'entity_id';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get State
     *
     * @return int
     */
    public function getState();

    /**
     * Get Auth
     *
     * @return int
     */
    public function getAuth();

    /**
     * Get created at date
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Get updated at date
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set ID
     *
     * @param int $id
     * @return \Jaagers\Authenticate\Api\Data\AuthorderInterface
     */
    public function setId($id);

    /**
     * Set States
     *
     * @param int $state
     * @return \Jaagers\Authenticate\Api\Data\AuthorderInterface
     */
    public function setState($state);

    /**
     * Set Auth
     *
     * @param int $auth
     * @return \Jaagers\Authenticate\Api\Data\AuthorderInterface
     */
    public function setAuth($auth);

    /**
     * Set created at
     *
     * @param string $created_at
     * @return \Jaagers\Authenticate\Api\Data\AuthorderInterface
     */
    public function setCreatedAt($created_at);

    /**
     * Set updated at
     *
     * @param string $updated_at
     * @return \Jaagers\Authenticate\Api\Data\AuthorderInterface
     */
    public function setUpdatedAt($updated_at);
}