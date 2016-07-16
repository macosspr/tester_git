<?php
namespace App\MainBundle\Routing;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RoutingControllerLoader implements LoaderInterface
{

    private $loaded = false;

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function get($id)
    {
        return $this->container->get($id);
    }

    public function load($resource, $type = null)
    {

        
        if (true === $this->loaded) {
            throw new \RuntimeException('Do not add the "routing_controller_loader" loader twice2');
        }
        
        
        $collection = new RouteCollection();
        //$bIsGlobalModule = $this->container->get('my_helper')->getCurrentSubdomain() == '';
        
        
        $collection->add('homepage', new Route('/', array(
                '_controller' => 'AppMainBundle:Frontend/Default:index',
        ), array(), array(), '', array($this->container->getParameter('schema'))));
        
        
        //var_dump($this->container->get('my_helper')->getCurrentSubdomain());
        //routing hotelowy
        if($this->get('permission_access')->isHotelApp()){
            
            
            //routing globalny
            if($this->container->get('session')->get('_current_config')['forward'] == 'listing'){
                
              //var_dump($this->container->get('session')->get('_current_config')['forward']);
                
                /*
                $collection->add('homepage', new Route('/', array(
                                                                '_controller' => 'AppMainBundle:Frontend/Searcher:hotelSearcher',
                                                        ), array(), array(), '', array('https')));
                */
                
                
             
                $collection->add('homepage', new Route('/', array(
                                                                '_controller' => 'AppMainBundle:Frontend/Searcher:hotelSearcher',
                                                        ), array(), array(), '', array($this->container->getParameter('schema'))));
                
                
                
                //, array(), array(), array(), '', array('https'))
                
                /*$collection->add('hotel_searcher', new Route('/hotels/', array(
                                                                '_controller' => 'AppMainBundle:Frontend/Searcher:hotelSearcher',
                                                        ), array( ) , array(), array(), '', array('https')));
                
                
                $collection->add('secure', new Route('/secure', array(
                        '_controller' => 'AppMainBundle:Frontend/Searcher:hotelSearcher',
                ), array(), array(), '', array('https')));
                */
                
                
            //hotel lobby    
            } else if($this->container->get('session')->get('_current_config')['forward'] == 'lobby'){
                
                
                $collection->add('homepage', new Route('/', array(
                        '_controller' => 'AppMainBundle:Frontend/HotelLobby:controller',
                ), array(), array(), '', array($this->container->getParameter('schema'))));
                
                
                
            }
            
        }
        
        
        
        
        
        
        
        
        
        $this->loaded = true;
        
        return $collection;
        
    }
    public function supports($resource, $type = null)
    {
        return 'routing_controller_loader' === $type;
    }
    
    public function getResolver()
    {
        // needed, but can be blank, unless you want to load other resources
        // and if you do, using the Loader base class is easier (see below)
    }
    
    public function setResolver(LoaderResolverInterface $resolver)
    {
        // same as above
    }
}
