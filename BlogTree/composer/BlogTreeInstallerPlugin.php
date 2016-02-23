<?php namespace bt\composer;


use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class BlogTreeInstallerPlugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io){
        $installer = new BlogTreeInstaller($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }
}
