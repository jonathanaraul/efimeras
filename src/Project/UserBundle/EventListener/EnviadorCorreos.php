<?php
// src/Acme/SearchBundle/EventListener/SearchIndexer.php
namespace Project\UserBundle\EventListener;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Project\BackBundle\Controller\UtilitiesAPI;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Project\UserBundle\Entity\Mensaje;
use Project\UserBundle\Entity\Newsletter;

class EnviadorCorreos
{
	protected $container;

	public function __construct(ContainerInterface $container)
	{
		$this->container = $container;
	}
    public function postUpdate(LifecycleEventArgs $args) {
        /*$entity = $args->getEntity();
        $em = $args->getEntityManager('milcasinos');
        if ($entity instanceof Noticia) {
           // echo'Itento actualizar una noticia con el estado'.$entity->getEstado();exit;

            if($entity->getEstado()==2){


            }

        }*/
    }
	public function postPersist (LifecycleEventArgs $args)
	{
        $entity = $args->getEntity();
        $em = $args->getEntityManager();
        $templating = $this->container->get('templating');
        $mailer = $this->container->get('mailer');

        if ($entity instanceof Mensaje) {

            $mensaje = 'Un usuario con correo: '. $entity->getRedactor() .' Te ha enviado el siguiente mensaje: '. $entity->getContenido(); 
            mail ( $entity->getDestinatario() , $entity->getAsunto() , $mensaje);

        }
        else if ($entity instanceof Newsletter) {

            $emails = $entity->getEmails();
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            for ($i=0; $i < count($emails); $i++) { 
                 mail ( $emails[$i]->getEmail() , $entity->getAsunto() , $entity->getContenido(), $cabeceras);     
            }           
        }
    }
}