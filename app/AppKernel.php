<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Avalanche\Bundle\ImagineBundle\AvalancheImagineBundle(),
            new RaulFraile\Bundle\LadybugBundle\RaulFraileLadybugBundle(),
            //new HWI\Bundle\OAuthBundle\HWIOAuthBundle(),
            new Bazinga\Bundle\GeocoderBundle\BazingaGeocoderBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new OldSound\RabbitMqBundle\OldSoundRabbitMqBundle(),
            new Genemu\Bundle\FormBundle\GenemuFormBundle(),
            new Knp\Bundle\GaufretteBundle\KnpGaufretteBundle(),
            new Vich\UploaderBundle\VichUploaderBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            new Project\BackBundle\ProjectBackBundle(),
            new Project\UserBundle\ProjectUserBundle(),
            new Project\FrontBundle\ProjectFrontBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new Desarrolla2\Bundle\RSSClientBundle\RSSClientBundle(),
            new Trsteel\CkeditorBundle\TrsteelCkeditorBundle(),
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Sonata\IntlBundle\SonataIntlBundle(),
            new Sonata\MediaBundle\SonataMediaBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Application\Sonata\MediaBundle\ApplicationSonataMediaBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
