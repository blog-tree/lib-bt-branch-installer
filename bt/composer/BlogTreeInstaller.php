<?php namespace bt\composer;


use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class BlogTreeInstaller extends LibraryInstaller
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
    }
    
    public function supports($packageType)
    {
        return self::EXT_NAME_KEY === $packageType;
    }
}
