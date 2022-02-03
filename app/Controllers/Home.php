<?php

namespace App\Controllers;
use SimpleXMLElement;

class Home extends BaseController
{
    /**
     * Home::index()
	 *
     * Load the books from XML
     */
    public function index()
    {
        $data = $this->readXML();
        $data = [
            'data'  => $data['record']
        ];

        return view('template',$data);
    }

   /**
     * Home::view()
	 *
     * Load the books from XML
     */
    public function view()
    {
        $data = $this->readXML();
        $data = [
            'data'  => $data['record']
        ];

        return view('template',$data);
    }

    /**
     * Admin::create()
	 *
     * Show the Add book form
     */
    public function create()
    {
        $book_data = [
            'update'  => ''
        ];

        return view('template',$book_data);
    }

    /**
     * Home::edit()
	 *
     * Load the book details based on id
     */
    public function edit()
    {
        $id = $this->request->uri->getSegment(2);
        $data = $this->readXML($id);

        $data = [
            'update'  => $data
        ];
        return view('template', $data );
    }

    /**
     * Home::update()
	 *
     * Add/update book entry into XML
     */
    public function update()
    {
        if ($this->request->getMethod() == "post") {
            $data = $this->readXML();

            $hidden_id = $this->request->getVar("hidden_id");
            $author = $this->request->getVar("author");
            $title = $this->request->getVar("title");
            $genre = $this->request->getVar("genre");
            $price = $this->request->getVar("price");
            $publisheddate = $this->request->getVar("publisheddate");
            $description = $this->request->getVar("description");

            $total = count($data['record']);

            if (!$hidden_id) {
                $id = 'bk' . $total + 150;
                $data['record'][$id]['id'] = $id;
                $data['record'][$id]['author'] = $author;
                $data['record'][$id]['title'] = $title;
                $data['record'][$id]['genre'] = $genre;
                $data['record'][$id]['price'] = $price;
                $data['record'][$id]['publish_date'] = $publisheddate;
                $data['record'][$id]['description'] = $description;
            } else {
                $data['record'][$hidden_id]['id'] = $hidden_id;
                $data['record'][$hidden_id]['author'] = $author;
                $data['record'][$hidden_id]['title'] = $title;
                $data['record'][$hidden_id]['genre'] = $genre;
                $data['record'][$hidden_id]['price'] = $price;
                $data['record'][$hidden_id]['publish_date'] = $publisheddate;
                $data['record'][$hidden_id]['description'] = $description;
            }
            $this->generateXML($data);
            return redirect()->to('/');
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Home::delete()
	 *
     * Delete book entry from XML
     */
    public function delete()
    {
        $id = $this->request->uri->getSegment(2);
        $data = $this->readXML();
        unset($data['record'][$id]);

        $book_data = [
            'data'  => $data['record']
        ];

        //This function create a xml object with element root.
        $this->generateXML($data);
        return view('template',$book_data);
    }

    /**
     * Home::readXML()
	 *
     * Read book XML and retrun as array
     */
    public function readXML($id=NULL) {
        $newArr = array(
            'title' => 'Book',
            'record' => array()
        );
        //$xml_file_name = base_url() .'/xml/books.xml';
        $xml_file_name = "./xml/books.xml";
        if (file_exists($xml_file_name)) {
            // Read entire file into string 
            $xmlfile = file_get_contents($xml_file_name); 
            
            // Convert xml string into an object 
            $new = simplexml_load_string($xmlfile); 
            
            // Convert into json 
            $con = json_encode($new); 
            
            // Convert into associative array 
            $results = json_decode($con, true); 

            if ($results) {
                foreach ($results as $data) {
                    foreach($data as $book) {
                        $newArr['record'][$book['@attributes']['id']]  = $book;
                    }
                }
            } else {
                $newArr['record'][$data[$i]['@attributes']['id']]  = $results['book'];
            }
        }

        if ($id) {
            return $newArr['record'][$id];
        } else {
            return $newArr;
        }
    }


    /**
     * Home::generateXML()
	 *
     * Generate XML
     */
    private function generateXML($data) {
        $title = 'catalog';
        $rowCount = count($data['record']);

        $xmlDoc = new SimpleXMLElement('<catalog/>');

        foreach($data['record'] as $index => $result){
            if(!empty($result)){
                $tabResults = $xmlDoc->addChild("book");
                $tabResults->addAttribute("id", $index);
                foreach($result as $key => $val){
                    if($key != '@attributes') {
                        $tabResults->addChild($key, $val);
                    }
                }
            }
        }
        
        header("Content-Type: text/xml");
       
        //save xml file
        $file_name = "./xml/books.xml";
        $xmlDoc->asXML($file_name);
        
        //return xml file name
        return $file_name;
    }
}
