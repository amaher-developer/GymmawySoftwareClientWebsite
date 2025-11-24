<?php

namespace App;

use Gecche\Multidomain\Foundation\Application as BaseMultidomainApplication;

class MultidomainApplication extends BaseMultidomainApplication
{
    /**
     * Get the environment file of the current domain using the mapping config.
     * Override the parent method to use multidomain.php mapping.
     *
     * @param string|null $domain
     * @return string
     */
    public function environmentFileDomain($domain = null)
    {
        $this->checkDomainDetection();

        $domain = $domain ?? $this['domain'] ?? '';
        
        // Load multidomain mapping config directly (might not be available via config() during bootstrap)
        $multidomainConfigPath = $this->basePath('config/multidomain.php');
        
        if (file_exists($multidomainConfigPath)) {
            $multidomainConfig = include $multidomainConfigPath;
            $mapping = $multidomainConfig['mapping'] ?? [];
            
            if (!empty($mapping)) {
                // Find the mapping entry that matches the current domain
                foreach ($mapping as $key => $config) {
                    if (isset($config['domains']) && in_array($domain, $config['domains'])) {
                        // Found matching domain in mapping, use the 'env' value
                        if (isset($config['env'])) {
                            $envFileName = '.env.' . $config['env'];
                            $envPath = $this->environmentPath() . DIRECTORY_SEPARATOR . $envFileName;
                            
                            // Check if the env file exists
                            if (file_exists($envPath)) {
                                return $envFileName;
                            }
                        }
                    }
                }
            }
        }
        
        // Fall back to parent's default behavior if mapping doesn't work
        return parent::environmentFileDomain($domain);
    }
}

