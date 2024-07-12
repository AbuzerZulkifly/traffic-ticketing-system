<?php 
  require ("../../fpdf/fpdf.php");
  require "../../registration/signup1/connect.php"; 

  //civilia and fine details
  $info=[
    "civilian"=>"",
    "nic_no"=>",",
    "license_no"=>"",
    "contact_no"=>"",
    "vehicle_no"=>"",
    "police_no"=>"",
    "issue_date"=>"",
    "end_date"=>"",
    "grand_total"=>"",
  ];
  
  //Select fine Details From Database
  $sql="select * from fine where id='{$_GET["id"]}'";
  $res=$con->query($sql);
  if($res->num_rows>0){
	  $row=$res->fetch_assoc();

	  $info=[
		"civilian"=>$row["name"],
		"nic_no"=>$row["nic_no"],
		"license_no"=>$row["license_no"],
		"contact_no"=>$row["contact_no"],
		"vehicle_no"=>$row["vehicle_no"],
    "police_no"=>$row["police_id"],
    "issued_date"=>date("d-m-Y",strtotime($row["start_date"])),
    "end_date"=>date("d-m-Y",strtotime($row["end_date"])),
		"grand_total"=>$row["total"]
	  ];
  }
  
  //fines
  $fine_info=[];
  
  $sql="select * from fine_sub where fine_no='{$_GET["id"]}'";
  $res=$con->query($sql);
  if($res->num_rows>0){
	  while($row=$res->fetch_assoc()){
		   $fine_info[]=[
			"rule"=>$row["rule"],
			"amount"=>$row["amount"],
		   ];
	  }
  }
  
  class PDF extends FPDF
  {
    function Header(){
      
      $this->SetFont('Arial','B',14);
      $this->Cell(50,10,"Ceylon Motor Traffic",0,1);
      $this->Cell(50,7,"PH : 119",0,1);
      
      //Display Fine text
      $this->SetY(15);
      $this->SetX(-100);
      $this->SetFont('Arial','B',18);
      $this->Cell(50,10,"Fine",0,1);
      
      //Display Horizontal line
      $this->Line(0,38,210,38);
    }
    
    function body($info,$fine_info){
      
      //Billing Details
      $this->SetY(45);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(50,10,"Fine To: ",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(50,7,$info["civilian"],0,1);
      $this->Cell(50,7,$info["license_no"],0,1);
      $this->Cell(50,7,$info["contact_no"],0,1);
      $this->Cell(50,7,$info["nic_no"],0,1);
      $this->Cell(50,7,$info["vehicle_no"],0,1);
      
      //Display fine no
      $this->SetY(55);
      $this->SetX(-60);
      
      //Display Invoice date
      $this->SetY(40);
      $this->SetX(-200);
      $this->Cell(50,7,"Start Date : ".$info["issued_date"]);
      $this->Cell(50,7,"End Date : ".$info["end_date"]);
      
      //Display Table headings
      $this->SetY(95);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(80,9,"Rule",1,0);
      $this->Cell(40,9,"amount",1,0);
      $this->SetFont('Arial','',12);
      
      //Display table fine rows
      foreach($fine_info as $row){
        $this->Cell(80,29,$row["rule"],"",0);
        $this->Cell(10,29,$row["amount"],"",0,"");
      }
      //Display table empty rows
      for($i=0;$i<12-count($fine_info);$i++)
      {
        $this->Cell(80,9,"","LR",0);
        $this->Cell(40,9,"","R",0,"R");
        $this->Cell(30,9,"","R",0,"C");
        $this->Cell(40,9,"","R",1,"R");
      }
      //Display table total row
      $this->SetFont('Arial','B',12);
      $this->Cell(80,9,"TOTAL",1,0,"R");
      $this->Cell(40,9,$info["grand_total"],1,1,"R");
      
    }
      
    
    function Footer(){
      
      //set footer position
      $this->SetY(-60);
      $this->Cell(0,10,"Authorized Signature",0,1,"R");
      $this->SetFont('Arial','',10);
      
      //Display Footer Text
      
    }
    
  }
  //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AddPage();
  $pdf->body($info,$fine_info);
  $pdf->Output();
?>