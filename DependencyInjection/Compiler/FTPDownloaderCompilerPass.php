<?php

namespace Touki\Bundle\FTPBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * FTP Downloader Compiler Pass
 * Handles downloader votables tags
 *
 * @author Touki <g.vincendon@vithemis.com>
 */
class FTPDownloaderCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $tagged     = $container->findTaggedServiceIds('ftp.downloader');
        $definition = $container->getDefinition('ftp.downloader.voter');

        foreach ($tagged as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $prepend = false;

                if (isset($attributes['prepend']) && $attributes['prepend'] == 'true') {
                    $prepend = true;
                }

                $definition->addMethodCall("addVotable", array(new Reference($id), $prepend));
            }
        }
    }
}
