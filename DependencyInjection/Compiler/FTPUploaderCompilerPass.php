<?php

namespace Touki\Bundle\FTPBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * FTP Uploader Compiler Pass
 * Handles uploader votables tags
 *
 * @author Touki <g.vincendon@vithemis.com>
 */
class FTPUploaderCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $tagged     = $container->findTaggedServiceIds('ftp.uploader');
        $definition = $container->getDefinition('ftp.uploader.voter');

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
