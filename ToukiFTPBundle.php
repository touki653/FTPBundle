<?php

namespace Touki\Bundle\FTPBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Touki\Bundle\FTPBundle\DependencyInjection\Compiler\FTPDownloaderCompilerPass;
use Touki\Bundle\FTPBundle\DependencyInjection\Compiler\FTPUploaderCompilerPass;

class ToukiFTPBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new FTPDownloaderCompilerPass);
        $container->addCompilerPass(new FTPUploaderCompilerPass);
    }
}
