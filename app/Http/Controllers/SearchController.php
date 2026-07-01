<?php

namespace App\Http\Controllers;

use App\Repositories\EnquiryRepositoryInterface;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $enquiryRepository;

    public function __construct(EnquiryRepositoryInterface $enquiryRepository)
    {
        $this->enquiryRepository = $enquiryRepository;
    }

    public function query(Request $request)
    {
        $q = $request->input('q', '');
        
        if (empty($q)) {
            return view('search.results', ['enquiries' => collect(), 'query' => $q]);
        }

        $enquiries = $this->enquiryRepository->globalSearch($q);

        return view('search.results', compact('enquiries', 'q'));
    }
}
