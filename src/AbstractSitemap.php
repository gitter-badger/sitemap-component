<?php
namespace League\Sitemap;

use League\Sitemap\Item\ValidatorTrait;

abstract class AbstractSitemap implements SitemapInterface
{
    use ValidatorTrait;

    /**
     * Variable holding the items added to a file.
     *
     * @var int
     */
    protected $totalItems = 0;

    /**
     * Array holding the files created by this class.
     *
     * @var array
     */
    protected $files = [];

    /**
     * Variable holding the number of files created by this class.
     *
     * @var int
     */
    protected $totalFiles = 0;

    /**
     * Maximum amount of URLs elements per sitemap file.
     *
     * @var int
     */
    protected $maxItemsPerSitemap = 50000;

    /**
     * @var int
     */
    protected $maxFilesize = 52428800; // 50 MB

    /**
     * @var bool
     */
    protected $gzipOutput;

    /**
     * @var string
     */
    protected $filePath;

    /**
     * @var string
     */
    protected $fileBaseName;

    /**
     * @var string
     */
    protected $fileExtension;

    /**
     * @var resource
     */
    protected $filePointer;

    /**
     * Due to the structure of a video sitemap we need to accumulate
     * the items under an array holding the URL they belong to.
     *
     * @var array
     */
    protected $items = [];

    /**
     * @param string $filePath
     * @param string $fileName
     * @param bool   $gzip
     */
    public function __construct($filePath, $fileName, $gzip = false)
    {
        $this->validateFilePath($filePath);
        $this->prepareOutputFile($filePath, $fileName);
        $this->createOutputPlaceholderFile();

        $this->gzipOutput = $gzip;
    }

    /**
     * @param string $filePath
     *
     * @throws FileSystemException
     */
    protected function validateFilePath($filePath)
    {
        if (false === (is_dir($filePath) && is_writable($filePath))) {
            throw new FileSystemException(
                sprintf("Provided path '%s' does not exist or is not writable.", $filePath)
            );
        }
    }

    /**
     * @param string $filePath
     * @param string $fileName
     */
    protected function prepareOutputFile($filePath, $fileName)
    {
        $this->filePath      = realpath($filePath);
        $pathParts           = pathinfo($fileName);
        $this->fileBaseName  = $pathParts['filename'];
        $this->fileExtension = $pathParts['extension'];
    }

    /**
     * @return bool
     * @throws SitemapFileExistsException
     */
    protected function createOutputPlaceholderFile()
    {
        $filePath = $this->getFullFilePath();

        if (true === file_exists($filePath)) {
            throw new SitemapFileExistsException(
                sprintf('Cannot create sitemap. File \'%s\' already exists.', $filePath)
            );
        }

        return touch($filePath);
    }

    /**
     * @return string
     */
    protected function getFullFilePath()
    {
        $number = (0 == $this->totalFiles) ? '' : $this->totalFiles;

        return $this->filePath . DIRECTORY_SEPARATOR . $this->fileBaseName . $number . "." . $this->fileExtension;
    }

    /**
     * @return bool
     */
    protected function isNewFileIsRequired()
    {
        return false === (
            ($this->getCurrentFileSize() <= $this->maxFilesize)
            && ($this->totalItems < $this->maxItemsPerSitemap)
        );
    }

    /**
     * @return integer
     */
    protected function getCurrentFileSize()
    {
        return filesize($this->getFullFilePath());
    }

    /**
     * Before appending data we need to check if we'll surpass the file size limit or not.
     *
     * @param $stringData
     *
     * @return bool
     */
    protected function isSurpassingFileSizeLimit($stringData)
    {
        $expectedFileSize = $this->getCurrentFileSize() + mb_strlen($stringData, mb_detect_encoding($stringData));

        return $this->maxFilesize < $expectedFileSize;
    }

    /**
     * @param        $item
     * @param string $url
     */
    protected function createAdditionalSitemapFile($item, $url = '')
    {
        $this->build();
        $this->totalFiles++;

        $this->createNewFilePointer();
        $this->appendToFile($this->getHeader());
        $this->appendToFile($item->build());
        $this->totalItems = 1;
    }

    /**
     * Generates sitemap file.
     *
     * @return mixed
     */
    public function build()
    {
        $this->appendToFile($this->getFooter());

        if ($this->gzipOutput) {
            $this->writeGZipFile();
        }

        fclose($this->filePointer);
    }

    /**
     * @param $xmlData
     */
    protected function appendToFile($xmlData)
    {
        fwrite($this->filePointer, $xmlData);
    }

    /**
     * @return string
     */
    abstract protected function getFooter();

    /**
     * @return bool
     */
    protected function writeGZipFile()
    {
        $status      = false;
        $gZipPointer = gzopen($this->getFullGZipFilePath(), 'w9');

        if ($gZipPointer !== false) {
            gzwrite($gZipPointer, file_get_contents($this->getFullFilePath()));
            $status = gzclose($gZipPointer);
        }
        return $status;
    }

    /**
     * @return string
     */
    protected function getFullGZipFilePath()
    {
        return $this->getFullFilePath() . '.gz';
    }

    /**
     *
     */
    protected function createNewFilePointer()
    {
        $this->filePointer = fopen($this->getFullFilePath(), 'w');
        $this->files[]     = $this->getFullFilePath();
    }

    /**
     * @return string
     */
    abstract protected function getHeader();

    /**
     * @param        $item
     * @param string $url
     *
     * @throws \InvalidArgumentException
     * @return $this
     */
    protected function delayedAdd($item, $url = '')
    {
        $this->validateItemClassType($item);

        if (false === $this->validateLoc($url)) {
            throw new \InvalidArgumentException(sprintf('Provided url is not valid.'));
        }

        $this->items[$url][] = $item->build();

        return $this;
    }

    /**
     * @param $item
     *
     * @throws SitemapException
     */
    abstract protected function validateItemClassType($item);


    /**
     *
     */
    protected function createSitemapFile()
    {
        if (null === $this->filePointer || 0 === $this->totalItems) {
            $this->createNewFilePointer();
            $this->appendToFile($this->getHeader());
        }
    }
}
