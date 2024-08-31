<?php

namespace Khaled\ApiCrudGenerator\Helpers;

use Illuminate\Support\Str;
use Khaled\ApiCrudGenerator\Constants\CrudGeneratorConstants;

class CrudHelper
{
    /**
     * Get the namespace from the configuration.
     *
     * @param string $key
     * @return string
     */
    public static function getNamespace($key)
    {
        return config($key);
    }

    /**
     * Get the path from the configuration.
     *
     * @param string $key
     * @return string
     */
    public static function getPath($key)
    {
        return config($key);
    }

    /**
     * Get the content of a stub file and replace placeholders.
     *
     * @param string $stubName
     * @param array $replacements
     * @return string
     */
    public static function getStubContent($stubName, $replacements = [])
    {
        $stubPath = __DIR__ . "/../Stubs/{$stubName}.stub";
        $stubContent = file_get_contents($stubPath);

        foreach ($replacements as $placeholder => $replacement) {
            $stubContent = str_replace("{{{$placeholder}}}", $replacement, $stubContent);
        }

        return $stubContent;
    }

    /**
     * Write content to a file.
     *
     * @param string $path
     * @param string $content
     * @return void
     */
    public static function writeFile($path, $content)
    {
        file_put_contents($path, $content);
    }

    /**
     * Generate the migration file path.
     *
     * @param string $tableName
     * @return string
     */
    public static function generateMigrationFilePath($tableName)
    {
        $timestamp = date('Y_m_d_His');
        $migrationPath = self::getPath(CrudGeneratorConstants::MIGRATION_PATH);
        $filePrefix = CrudGeneratorConstants::MIGRATION_FILE_PREFIX;
        $fileSuffix = CrudGeneratorConstants::MIGRATION_FILE_SUFFIX;
        return "{$migrationPath}/{$timestamp}_{$filePrefix}_{$tableName}{$fileSuffix}";
    }
}
