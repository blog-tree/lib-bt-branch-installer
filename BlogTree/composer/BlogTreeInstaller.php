<?php namespace bt\composer;


use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class BlogTreeInstaller extend LibraryInstaller
{
  const EXT_NAME_KEY = 'bt-extension-name';
  
  /**
   * Install extensions before vendor dir
   */
    public function getInstallPath(PackageInterface $package)
    {
        $this->initializeVendorDir();
        $basePath = ($this->vendorDir ? $this->vendorDir.'/' : '') . $package->getPrettyName();
        
        $extras = $package->getExtra();
        if (!is_null($extras) && isset($extras[self::EXT_NAME_KEY]) && !empty($extras[self::EXT_NAME_KEY])) {
          // get extension
          return $basePath . '../' . $extras[self::EXT_NAME_KEY];
        } else {
          // default path
          $targetDir = $package->getTargetDir();
          return $basePath . ($targetDir ? '/'.$targetDir : '');
        }
        $this->io->writeError('    <warning>Skipped installation of bin '.$bin.' for package '.$package->getName().': file not found in package</warning>');
    }
  
}
