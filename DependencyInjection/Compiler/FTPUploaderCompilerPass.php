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

        foreach ($tagged as $id => $attributes) {
            $definition->addMethodCall("addVotable", array(new Reference($id)));
        }
    }
}
