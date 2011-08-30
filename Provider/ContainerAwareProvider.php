<?php

namespace Knp\Bundle\MenuBundle\Provider;

use Knp\Menu\Provider\MenuProviderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ContainerAwareProvider implements MenuProviderInterface
{
    private $container;
    private $menuIds;

    public function __construct(ContainerInterface $container, array $menuIds = array())
    {
        $this->container = $container;
        $this->menuIds = $menuIds;
    }

    public function get($name)
    {
        if (!isset($this->menuIds[$name])) {
            throw new \InvalidArgumentException(sprintf('The menu "%s" is not defined.', $name));
        }

        return $this->container->get($this->menuIds[$name]);
    }

    public function has($name)
    {
        return isset($this->menuIds[$name]);
    }

    public function addMenu($name, $serviceId)
    {
        $this->menuIds[$name] = $serviceId;
    }
}
