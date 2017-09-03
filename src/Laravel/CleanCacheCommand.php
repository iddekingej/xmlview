<?php 
declare(strict_types=1);
namespace XMLView\Laravel;

use Illuminate\Console\Command;
/**
 * Handles the xmlview::cleancache command
 * 
 *
 */
class CleanCacheCommand extends Command
{
    protected $signature = "xmlview:cleancache";
    protected $description = "Cleans the cache of xmlview";
    
    /**
     * Clean and remove directory 
     * @param string $p_path Path to directory for cleaning.
     * @return boolean  false success true and error occured
     */
    private function cleanDirectory(string $p_path):bool
    {
        if($this->removeFromPath($p_path."/")){
            return true;
        }
        
        if(rmdir($p_path)===false){
            $this->error("Can't remove directory $p_path");
            return true;
        }
        
        return false;
    }
    
    /**
     * Remove file from cache
     * 
     * @param string $p_path file to remove 
     * @return boolean false - success  True - failed
     */
    private function cleanFile(string $p_path):bool
    {
        if(unlink($p_path)===false){
            $this->error("Failed to remove the file $p_path");
            return true;
        }
        return false;
    }
    
    /**
     * Clean directory and sub directory recursively 
     * 
     * @param string $p_directory
     * @return boolean false - success  True - failed
     */
    
    private function removeFromPath(string $p_directory):bool
    {
        $l_files=scandir($p_directory);
        if($l_files===false){
            $this->error("Failed to read directory '$p_directory'");
            return true;
        }
        $l_failed=false;
        foreach($l_files as $l_file){
            
            if($l_file != "." && $l_file != ".."){
                $l_fullPath=$p_directory.$l_file;
                
                if(is_dir($l_fullPath)){
                    if($this->cleanDirectory($l_fullPath)){
                        $l_failed=true;
                    }
                } else {
                    if($this->cleanFile($l_fullPath)){
                        $l_failed=true;
                    }
                }
            }
            
        }
        return $l_failed;
    }
    
    /**
     * Execute command
     */
    
    public function handle()
    {
        if($this->removeFromPath(base_path(config("hr.xmlCache")))){
            $this->error("Cleaning cache failed");
        } else {
            $this->info("Cache cleaned");
        }
    }
}