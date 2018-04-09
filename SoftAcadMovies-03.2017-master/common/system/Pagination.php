<?php


class Pagination
{
    protected $baseUrl	= '';
    protected $totalRows = 0;
    protected $perPage	= 10;
    protected $numLinks = 5;
    protected $currentPage = 0;

    // Pagination Container
    protected $fullTagOpen	= '<div class="pagination pagination-centered"><ul class="pagination pagination-centered">';
    protected $fullTagClose = '</ul></div>';

    // Current Page Configuration
    protected $currentTagOpen = '<li class="page_number active"><a>';
    protected $currentTagClose = '</a></li>';

    // Page for disabled fields
    protected $disabledTagOpen = '<li class="page_number active"><a>';
    protected $disabledTagClose = '</a></li>';

    // Previous Link Configuration
    protected $previousLinkAlways = false;
    protected $previousLink = 'Prev';
    protected $previousTagOpen = '<li class="first">';
    protected $previousTagClose = '</li>';

    // Next Link Configuration
    protected $nextLinkAlways = false;
    protected $nextLink = 'Next';
    protected $nextTagOpen = '<li class="last">';
    protected $nextTagClose = '</li>';

    // Page Numbers Links Configuration
    protected $numberTagOpen = '<li class="page_number">';
    protected $numberTagClose = '</li>';

    // Query string to identify page number
    protected $pageQueryString = 'page';

    public function __construct()
    {
        $this->setBaseUrl($this->getBaseUrl());
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function create()
    {
        if ($this->totalRows == 0 || $this->perPage == 0) {
            throw new \Exception('No total rows set or per page setting');
        }

        $iNumPages = (int) ceil($this->totalRows / $this->perPage);

        $sBaseUrl = trim($this->baseUrl);
        $sFirstUrl = $sBaseUrl;

        $sQueryStringSeparator = (strpos($sBaseUrl, '?') === false) ? '?' : '&amp;';
        $sBaseUrl .= $sQueryStringSeparator.http_build_query(array($this->pageQueryString => ''));

        $iStart = (($this->currentPage - $this->numLinks) > 0) ? $this->currentPage - ($this->numLinks - 1) : 1;
        $iEnd = (($this->currentPage + $this->numLinks) < $iNumPages) ? $this->currentPage+$this->numLinks : $iNumPages;

        // And here we go...
        $output = array();


        // Render the "Previous" link.
        if ($this->previousLink !== false && ($this->currentPage !== 1 || $this->previousLinkAlways)) {

            if ($this->currentPage !== 1) {
                $i = $this->currentPage - 1;

                if ($i === 1) {
                    // First page
                    $output[] = $this->previousTagOpen.
                        '<a data-page-id="1" href="'.$sFirstUrl.'" title="Previous">'.$this->previousLink.'</a>'
                        .$this->previousTagClose;
                } else {
                    $output[] = $this->previousTagOpen.
                        '<a data-page-id="'.$i.'" href="'.$sBaseUrl.$i.'" title="Previous">'.$this->previousLink.'</a>'
                        .$this->previousTagClose;
                }
            } elseif ($this->previousLinkAlways) {
                $output[] = $this->disabledTagOpen.$this->previousLink.$this->disabledTagClose;
            }
        }

        // Write the digit links
        for ($loop = $iStart -1; $loop <= $iEnd; $loop++) {
            $i = $loop;
            if ($i >= 1) {
                if ($this->currentPage === $i) {
                    // Current page
                    if ($this->numLinks) {
                        $output[] = $this->currentTagOpen.$i.$this->currentTagClose;
                    }

                } elseif ($i === 1) {
                    // First page
                    $output[] = $this->numberTagOpen.'<a data-page-id="'.$i.'" href="'.$sFirstUrl.'">'.$i.'</a>'.$this->numberTagClose;
                } else {
                    $output[] = $this->numberTagOpen.'<a data-page-id="'.$i.'" href="'.$sBaseUrl.$i.'">'.$i.'</a>'.$this->numberTagClose;
                }
            }
        }

        // Render the "next" link
        if ($this->nextLink !== false && ($this->currentPage < $iNumPages || $this->nextLinkAlways)) {
            if ($this->currentPage < $iNumPages) {
                $i = $this->currentPage + 1;

                $output[] = $this->nextTagOpen.'<a data-page-id="'.$i.'" href="'.$sBaseUrl.$i.'" title="Next">'.$this->nextLink.'</a>'.$this->nextTagClose;
            } elseif ($this->nextLinkAlways) {
                $output[] = $this->disabledTagOpen.$this->nextLink.$this->disabledTagClose;
            }

        }

        $output = implode("\n\r", $output);
        $output = preg_replace('#([^:])//+#', '\\1/', $output);

        return $this->fullTagOpen.$output.$this->fullTagClose;
    }

    public function getOffset()
    {
        return array(
            'iOffset' => ($this->currentPage - 1) * $this->perPage,
            'iLimit' => $this->perPage,
            'iCurrentPage' => $this->currentPage
        );
    }

    /**
     * @param $firstLink
     * @return $this
     */
    public function setFirstLink($firstLink)
    {
        $this->firstLink = $firstLink;
        return $this;
    }

    /**
     * @param $bStatus
     * @return $this
     */
    public function setFirstLinkAlways($bStatus)
    {
        $this->firstLinkAlways = $bStatus;
        return $this;
    }

    /**
     * @param $firstTagClose
     * @return $this
     */
    public function setFirstTagClose($firstTagClose)
    {
        $this->firstTagClose = $firstTagClose;
        return $this;
    }

    /**
     * @param $firstTagOpen
     * @return $this
     */
    public function setFirstTagOpen($firstTagOpen)
    {
        $this->firstTagOpen = $firstTagOpen;
        return $this;
    }

    /**
     * @param $fullTagClose
     * @return $this
     */
    public function setFullTagClose($fullTagClose)
    {
        $this->fullTagClose = $fullTagClose;
        return $this;
    }

    /**
     * @param $fullTagOpen
     * @return $this
     */
    public function setFullTagOpen($fullTagOpen)
    {
        $this->fullTagOpen = $fullTagOpen;
        return $this;
    }

    /**
     * @param $lastLink
     * @return $this
     */
    public function setLastLink($lastLink)
    {
        $this->lastLink = $lastLink;
        return $this;
    }

    /**
     * @param $bStatus
     * @return $this
     */
    public function setLastLinkAlways($bStatus)
    {
        $this->lastLinkAlways = $bStatus;
        return $this;
    }

    /**
     * @param $lastTagClose
     * @return $this
     */
    public function setLastTagClose($lastTagClose)
    {
        $this->lastTagClose = $lastTagClose;
        return $this;
    }

    /**
     * @param $lastTagOpen
     * @return $this
     */
    public function setLastTagOpen($lastTagOpen)
    {
        $this->lastTagOpen = $lastTagOpen;
        return $this;
    }

    /**
     * @param $nextLink
     * @return $this
     */
    public function setNextLink($nextLink)
    {
        $this->nextLink = $nextLink;
        return $this;
    }

    /**
     * @param $bStatus
     * @return $this
     */
    public function setNextLinkAlways($bStatus)
    {
        $this->nextLinkAlways = $bStatus;
        return $this;
    }

    /**
     * @param $nextTagClose
     * @return $this
     */
    public function setNextTagClose($nextTagClose)
    {
        $this->nextTagClose = $nextTagClose;
        return $this;
    }

    /**
     * @param $nextTagOpen
     * @return $this
     */
    public function setNextTagOpen($nextTagOpen)
    {
        $this->nextTagOpen = $nextTagOpen;
        return $this;
    }

    /**
     * @param $numLinks
     * @return $this
     */
    public function setNumLinks($numLinks)
    {
        $this->numLinks = $numLinks;
        return $this;
    }

    /**
     * @param $numberTagClose
     * @return $this
     */
    public function setNumberTagClose($numberTagClose)
    {
        $this->numberTagClose = $numberTagClose;
        return $this;
    }

    /**
     * @param $numberTagOpen
     * @return $this
     */
    public function setNumberTagOpen($numberTagOpen)
    {
        $this->numberTagOpen = $numberTagOpen;
        return $this;
    }

    /**
     * @param $perPage
     * @return $this
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        $this->setCurrentPage();
        return $this;
    }

    /**
     * @param $previousLink
     * @return $this
     */
    public function setPreviousLink($previousLink)
    {
        $this->previousLink = $previousLink;
        return $this;
    }

    /**
     * @param $bStatus
     * @return $this
     */
    public function setPreviousLinkAlways($bStatus)
    {
        $this->previousLinkAlways = $bStatus;
        return $this;
    }

    /**
     * @param $previousTagClose
     * @return $this
     */
    public function setPreviousTagClose($previousTagClose)
    {
        $this->previousTagClose = $previousTagClose;
        return $this;
    }

    /**
     * @param $previousTagOpen
     * @return $this
     */
    public function setPreviousTagOpen($previousTagOpen)
    {
        $this->previousTagOpen = $previousTagOpen;
        return $this;
    }

    /**
     * @param $totalRows
     * @return $this
     */
    public function setTotalRows($totalRows)
    {
        $this->totalRows = $totalRows;
        $this->setCurrentPage();
        return $this;
    }

    /**
     * @param $currentTagOpen
     * @return $this
     */
    public function setCurrentTagOpen($currentTagOpen)
    {
        $this->currentTagOpen = $currentTagOpen;
        return $this;
    }

    /**
     * @param $currentTagClose
     * @return $this
     */
    public function setCurrentTagClose($currentTagClose)
    {
        $this->currentTagClose = $currentTagClose;
        return $this;
    }

    /**
     * @param $baseUrl
     * @return $this
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    private function setCurrentPage()
    {
        $iNumPages = (int) ceil($this->totalRows / $this->perPage);

        if (isset($_GET[$this->pageQueryString])) {
            $this->currentPage = (int)$_GET[$this->pageQueryString];
        }

        if (!is_numeric($this->currentPage) || (int)$this->currentPage === 0) {
            $this->currentPage = 1;
        } else {
            $this->currentPage = (int) $this->currentPage;
        }

        if ($this->currentPage > $iNumPages) {
            $this->currentPage = $iNumPages;
        }

        if ($this->currentPage > $this->totalRows) {
            $this->currentPage = ($iNumPages - 1) * $this->perPage;
        }

        return true;
    }

    /**
     * @return string
     */
    private function getBaseUrl()
    {
        return $this->baseUrl;
    }
}