<?php
/**
 *
 * Copyright (C) 2016  Yinka Ashon
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */
namespace AshonIkon\Bridge;

use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManager;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\ModuleEvent;

/**
 * Class Module
 * @package AshonIkon\Bridge
 */
class Module implements BootstrapListenerInterface
{
    /**
     * {@inheritdoc}
     */
    public function onBootstrap(EventInterface $e)
    {
        /** @var EventManager $em */
        $em = $e->getTarget()->getEventManager();
        // Registering a listener at to initialize our NAVision connection once all is good to go.
        $em->attach(ModuleEvent::EVENT_LOAD_MODULE, array($this, 'registerNewPhpHelpers'));

    }

    /**
     * Helps to register the new PHP7 project dependencies
     * @param ModuleEvent $event
     */
    public function registerNewPhpHelpers(ModuleEvent $event)
    {
        /** @var \Zend\ServiceManager\ServiceManager $sm */
        $sm = $event->getParam('ServiceManager');
        $sm->get('NavConnection'); // Just finger it.
    }


}
