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
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Evence\Bundle\SoftDeleteableExtensionBundle\EvenceSoftDeleteableExtensionBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Knp\Bundle\TimeBundle\KnpTimeBundle(),
            new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
            new Braincrafted\Bundle\BootstrapBundle\BraincraftedBootstrapBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Vich\UploaderBundle\VichUploaderBundle(),
            new Liip\ImagineBundle\LiipImagineBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Uni\AdminBundle\UniAdminBundle(),
            new Uni\OfferBundle\UniOfferBundle(),
            new Uni\UserBundle\UniUserBundle(),
            new Uni\ControlPanelBundle\UniControlPanelBundle(),
            new Uni\PageBundle\UniPageBundle(),
            new Uni\CatalogBundle\UniCatalogBundle(),
            new Uni\PublicBundle\UniPublicBundle(),
            new Uni\AccountBundle\UniAccountBundle(),
            new Uni\PortfolioBundle\UniPortfolioBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Uni\AdminGeneratorBundle\UniAdminGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
