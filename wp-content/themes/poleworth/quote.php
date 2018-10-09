<?php
	
	require_once("quoteware2.php");
	$term = isset($_POST['term']) ? $_POST['term'] : '36';
	$deposit = isset($_POST['deposit']) ? $_POST['deposit'] : '2000';
	$annual_mileage = isset($_POST['annual_mileage']) ? $_POST['annual_mileage'] : '12000';
	$mileage = isset($_POST['mileage']) ? $_POST['mileage'] : '12000';
	$price = isset($_POST['price']) ? $_POST['price'] : '1000';
	$cap_id = isset($_POST['cap']) ? $_POST['cap'] : '';
	$registration = isset($_POST['registration']) ? $_POST['registration'] : '';
	$year = isset($_POST['year']) ? $_POST['year'] : '2005';
	try
	{
		
		$soap_wsdl = "http://quoteware2.webzation.ws/Quoteware2.svc?wsdl";
		$soap_options = array(
							"trace"    => 1, 
							"classmap" => $class_map,
							"style"    => SOAP_DOCUMENT,
                            "use"      => SOAP_LITERAL,
							"features" => SOAP_SINGLE_ELEMENT_ARRAYS,
							"soap_version"	=> SOAP_1_1,
							"encoding"    		=> "UTF-8"
							);
		/*printf("<table border=1>");
		printf("<th colspan=2>Quote Parameters</th>");
		printf("<tr><td>Term:</td> <td>%s</td>",$term);
		printf("<tr><td>Deposit:</td> <td>%s</td>",$deposit);
		printf("<tr><td>Annual Mileage:</td> <td>%s</td>",$annual_mileage);
		
		
		printf("</table>");*/
		echo '<table>';
			echo '<thead>';
				echo '<tr>';
					echo '<th>Product</th>';
					echo '<th>APR</th>';
					echo '<th>Interest Rate</th>';
					echo '<th>Cash Price</th>';
					echo '<th>Advance</th>';
					echo '<th>Interest</th>';
					echo '<th>Acceptance Fee</th>';
					echo '<th>Purchase Fee</th>';
					echo '<th>Total Charges</th>';
					echo '<th>Total Payable</th>';
					echo '<th>Monthly Payment</th>';
					echo '<th>Final Payment</th>';
			echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
		
		$QWv2Client = new SoapClient($soap_wsdl, $soap_options);
	
		$objGetQuotes = new GetQuotes();
		@$GetQuotes->Credentials = new Credentials;
		
		$GetQuotes->Credentials->Username = "www.polesworthgarageltd.com";
		$GetQuotes->Credentials->Password = "p0l35w0rthg4r4g3";
		
		$quote_request_number = 1;
		for($count=0; $count<$quote_request_number; $count++)
		{
			$arrQuoteRequests[$count] = new QuoteRequest;
			$arrQuoteRequests[$count]->GlobalRequestParameters = new RequestParameters;
			$arrQuoteRequests[$count]->GlobalRequestParameters->ComputationPath = "Default";
			$arrQuoteRequests[$count]->GlobalRequestParameters->Term = $term;
			$arrQuoteRequests[$count]->GlobalRequestParameters->TermUnit = "Months";
			$request_number = 1;
			
			for($count2=0; $count2<$request_number; $count2++)
			{			
			 	$arrRequests[$count2] = new Request;
			 	$arrRequests[$count2]->Figures = new RequestFigures;
			 	$arrRequests[$count2]->Figures->CashPrice = $price;
			 	$arrRequests[$count2]->Figures->CashDeposit = $deposit;
                $arrRequests[$count2]->Figures->Asset = new RequestFiguresAssetMotorVehicle;
				//$arrRequests[$count2]->Figures->Asset->ManualResidualValue = $price;
				$arrRequests[$count2]->Figures->Asset->AnnualDistance = $annual_mileage;
				$arrRequests[$count2]->Figures->Asset->OutstandingSettlement = 0;
				$arrRequests[$count2]->Figures->Asset->PartExchange = 0;
				$arrRequests[$count2]->Asset = new RequestAssetMotorVehicle;
				$arrRequests[$count2]->Asset->Class = "Car";
				$arrRequests[$count2]->Asset->Condition = "Used";
				$arrRequests[$count2]->Asset->CurrentOdometerReading = $mileage;
				$arrRequests[$count2]->Asset->Identity = $registration;
				//$arrRequests[$count2]->Asset->Identity = "36619";
				$arrRequests[$count2]->Asset->IdentityType = "VRM";	
				$arrRequests[$count2]->Asset->RegistrationDate = date_create($year.'-01-01')->format("Y-m-d\TH:i:s"); 
				$arrRequests[$count2]->Asset->StockIdentity = $registration;
				$arrRequests[$count2]->Asset->Source = "RegionCurrent";
				$arrRequests[$count2]->Asset->StockLocation = "12345";
				//$arrRequests[$count2]->Asset->StockingDate = date_create("1/1/2008")->format("Y-m-d\TH:i:s");
				
			}
			$objArrayOfRequest = new ArrayOfRequest;
			$objArrayOfRequest->Request = $arrRequests;
			$arrQuoteRequests[$count]->Requests = $objArrayOfRequest;			//Add all Requests to QuoteRequest
			
		}
		
		$objArrayOfQuoteRequest = new ArrayOfQuoteRequest;
		$objArrayOfQuoteRequest->QuoteRequest = $arrQuoteRequests;
		$GetQuotes->QuoteRequests = $objArrayOfQuoteRequest;						//Add all QuoteRequests 
		
		//Call Quoteware2 GetQuotes with built objects
		$objGetQuotesResponse = $QWv2Client->GetQuotes($GetQuotes);
		
		//Process Response
		//var_dump($objGetQuotesResponse);
		$objQuoteResponse = $objGetQuotesResponse->GetQuotesResult;
		
		if ($objQuoteResponse->hasErrors)
		{
			if ($objQuoteResponse->Errors->hasPrivateErrors)
			{
				foreach ($objQuoteResponse->Errors->PrivateErrors->Error as $objError)
				{
				}
			}
			if ($objQuoteResponse->Errors->hasPublicErrors)
			{
				foreach ($objQuoteResponse->Errors->PublicErrors->Error as $objError)
				{
				}
			}
		}
		if ($objQuoteResponse->hasWarnings)
		{
			if ($objQuoteResponse->Warnings->hasPrivateWarnings)
			{
				foreach ($objQuoteResponse->Warnings->PrivateWarnings->Warning as $objWarning)
				{
				}
			}
			if ($objQuoteResponse->Warnings->hasPublicWarnings)
			{
				foreach ($objQuoteResponse->Warnings->PublicWarnings->Warning as $objWarning)
				{
				}
			}
		}
		
	
		if ($objQuoteResponse->hasQuoteResults)
		{
			
			foreach ($objQuoteResponse->QuoteResults->QuoteResult as $objQuoteResult)
			{
				if ($objQuoteResult->hasErrors) 
				{
					if ($objQuoteResult->Errors->hasPrivateErrors) 
					{
						foreach ($objQuoteResult->Errors->PrivateErrors->Error as $objError)
						{
						}
					}
					if ($objQuoteResult->Errors->hasPublicErrors) 
					{
						foreach ($objQuoteResult->Errors->PublicErrors->Error as $objError)
						{
						}
					}
				}
				if ($objQuoteResult->hasWarnings) 
				{
					if ($objQuoteResult->Warnings->hasPrivateWarnings) 
					{
						foreach ($objQuoteResult->Warnings->PrivateWarnings->Warning as $objWarning)
						{
						}
					}
					if ($objQuoteResult->Warnings->hasPublicWarnings) 
					{
						foreach ($objQuoteResult->Errors->PublicWarning->Warning as $objWarning)
						{
						}
					}
				}
			}
			if ($objQuoteResult->hasResults)
			{ 
				foreach ($objQuoteResult->Results->Result as $objResult)////->Result
				{
					if ($objResult->hasErrors)
					{
				
						if ($objResult->Errors->hasPrivateErrors)                           
						{
							foreach ($objResult->Errors->PrivateErrors->Error as $objError)
							{
							}
						}
						
						if ($objResult->Errors->hasPublicErrors)
						{
							foreach ($objResult->Errors->PublicErrors->Error as $objError)
							{
							}
						}
					}
					
					if ($objResult->hasWarnings)
					{
						if ($objResult->Warnings->hasPrivateWarnings)
						{
							foreach ($objResult->Warnings->PrivateWarnings->Warning as $objWarning)
							{
							}
						}
						
						if ($objResult->Warnings->hasPublicWarnings)
						{
							foreach ($objResult->Errors->PublicWarnings->Warning as $objWarning)
							{
							}
						}
					 }
				
				
					if ($objResult->hasProductGroup)
					{
						/*switch (get_class($objResult->Asset))
						{
							Case "ResultAssetMotorVehicle":
				
								$objAssetMotorVehicle = $objResult->Asset;
								
								printf("<table border=1>");
								printf("<th colspan=2>Asset - Motor Vehicle Details</th>");
								
								printf("<tr><td>Vehicle Age:</td><td>%s mths</td></tr>", $objAssetMotorVehicle->Age);
										
								printf("<tr><td>Age Identifier:</td><td>%s</td></tr>", $objAssetMotorVehicle->AgeIdentifier);
								
								switch ($objAssetMotorVehicle->IdentityType)
								{
				
									Case "VRM":
										printf("<tr><td>VRM:</td><td>%s</td></tr>", $objAssetMotorVehicle->Identity);
										break;				
								}
				
								printf("<tr><td>Mileage at end:</td><td>%s</td></tr>", $objAssetMotorVehicle->TermDistance);
								printf("<tr><td>Current Mileage:</td><td>%s</td></tr>", $objAssetMotorVehicle->CurrentOdometerReading);
								
								printf("</table>");
								
								break;
				
						}*/
						
						
						//##############
						
						foreach ($objResult->ProductGroups->ProductGroup as $objProductGroup)
						{
							/*if ($objProductGroup->hasErrors)
							{
								if ($objProductGroup->Errors->hasPrivateErrors)
								{
									foreach ($objProductGroup->Errors->PrivateErrors->Error as $objError)
									{
									   printf("<p>Product Group Private Error: %s %s</p>", $objError->Number, $objError->Message);
									}
								}
								if ($objProductGroup->Errors->hasPublicErrors)
								{
									foreach ($objProductGroup->Errors->PublicErrors->Error as $objError)
									{
									   printf("<p>Product Group Public Error: %s %s</p>", $objError->Number, $objError->Message);
									}
								}
							}
							if ($objProductGroup->hasWarnings)
							{
								if ($objProductGroup->Warnings->hasPrivateWarnings)
								{
									foreach ($objProductGroup->Warnings->PrivateWarnings->Warning as $objWarning)
									{
									   printf("<p>Product Group Private Warning: %s %s</p>", $objWarning->Number, $objWarning->Message);
									}
								}
								if ($objProductGroup->Warnings->hasPublicWarnings)
								{
									foreach ($objProductGroup->Errors->PublicWarnings->Warning as $objWarning)
									{
									   printf("<p>Product Group Public Warning: %s %s</p>", $objWarning->Number, $objWarning->Message);
									}
								}
							}*/
							if ($objProductGroup->hasProductQuote)
							{
								$i = 0;
								foreach ($objProductGroup->ProductQuotes->ProductQuote as $objProductQuote)
								{
									/*if ($objProductQuote->hasErrors)
									{
										printf("<table border=1>");
										printf("<th colspan=2>Product Quote Errors</th>");
										printf("<tr><td>Product Name:</td><td>%s</td></tr>", $objProductQuote->ProductName);
										if ($objProductQuote->Errors->hasPrivateErrors)
										{
											foreach ($objProductQuote->Errors->PrivateErrors->Error as $objError)
											{
											   printf("<tr><td>Private Error:</td><td>%s %s</td></tr>", $objError->Number, $objError->Message);
											}
										}
										if ($objProductQuote->Errors->hasPublicErrors)
										{
											foreach ($objProductQuote->Errors->PublicErrors->Error as $objError)
											{
											   printf("<tr><td>Public Error:</td><td>%s %s</td></tr>", $objError->Number, $objError->Message);
											}
										}
										printf("</table>");
									}*/
									/*if ($objProductQuote->hasWarnings)
									{
										if (!$objProductQuote->hasErrors)
{
										printf("<table border=1>");
										printf("<th colspan=2>Product Quote Warnings</th>");
										printf("<tr><td>Product Name:</td><td>%s</td></tr>", $objProductQuote->ProductName);
										
										}
										if ($objProductQuote->Warnings->hasPrivateWarnings)
{
											foreach ($objProductQuote->Warnings->PrivateWarnings->Warning as $objWarning)
											{
											   printf("<tr><td>Private Warning:</td><td>%s %s</td></tr>", $objWarning->Number, $objWarning->Message);
											}
										}
										if ($objProductQuote->Warnings->hasPublicWarnings)
{
											foreach ($objProductQuote->Errors->PublicWarnings->Warning as $objWarning)
											{
											   printf("<tr><td>Product Quote Public Warning: </td><td>%s %s</td></tr>", $objWarning->Number, $objWarning->Message);
											}
										}
										printf("</table>");
									}*/
									if (!$objProductQuote->hasErrors)
									{       //No Quote Errors or Warnings
										$i++;
										/*printf("<table border=1>");
										printf("<th colspan=2>%s Quote</th>",$objProductQuote->FacilityType);
										printf("<tr><td>Product Name:</td><td>%s</td></tr>", $objProductQuote->ProductName);
										printf("<tr><td colspan=2>&nbsp;</td></tr>");
										printf("<tr><td>QuotedDateTime: </td><td>%s</td></tr>", $objProductQuote->QuotedDateTime);
										printf("<tr><td>ExpiryDate: </td><td>%s</td></tr>", $objProductQuote->ExpiryDate);
										printf("<tr><td>QuoteUID: </td><td>%s</td></tr>", $objProductQuote->QuoteUID);
										printf("<tr><td colspan=2>&nbsp;</td></tr>");
										printf("<tr><td>APR: </td><td>%s %%</td></tr>", $objProductQuote->Figures->APR);
										printf("<tr><td>Interest Rate: </td><td>%s %%</td></tr>", $objProductQuote->Figures->InterestRate);										
										printf("<tr><td>Total Cash Price: </td><td>&pound;
%01.2f</td></tr>", $objProductQuote->Figures->TotalCashPrice);
										printf("<tr><td>Total Deposit: </td><td>&pound;
%01.2f</td></tr>", $objProductQuote->Figures->TotalDeposit);
										printf("<tr><td>Advance: </td><td>&pound;
%01.2f</td></tr>", $objProductQuote->Figures->Advance);
										printf("<tr><td>Interest Charges: </td><td>&pound;
%01.2f</td></tr>", $objProductQuote->Figures->InterestCharges);
										printf("<tr><td>Acceptance Fee: </td><td>&pound;
%01.2f</td></tr>", $objProductQuote->Figures->AcceptanceFee);
										printf("<tr><td>Option To Purchase Fee: </td><td>&pound;
%01.2f</td></tr>", $objProductQuote->Figures->OptionToPurchaseFee);
										printf("<tr><td>Total Charges: </td><td>&pound;
%01.2f</td></tr>", $objProductQuote->Figures->TotalCharges);
										printf("<tr><td>Total Payable: </td><td>&pound;
%01.2f</td></tr>", $objProductQuote->Figures->TotalPayable);
										printf("<tr><td colspan=2>&nbsp;</td></tr>");
										printf("<tr><td>First Payment: </td><td>&pound;
%01.2f</td></tr>", $objProductQuote->Figures->FirstPayment);
										printf("<tr><td>%s Payments of:</td><td>&pound;
%01.2f</td></tr>", $objProductQuote->Figures->NumberOfRegularPayments, $objProductQuote->Figures->RegularPayment);
										printf("<tr><td>Final Payment: </td><td>&pound;
%01.2f</td></tr>", $objProductQuote->Figures->FinalPayment);*/
										
										
											echo '<tr>';
												echo '<td><strong>' . $objProductQuote->FacilityType . '</strong></td>';
												echo '<td>' . $objProductQuote->Figures->APR . '%</td>';
												echo '<td>' . $objProductQuote->Figures->InterestRate . '%</td>';
												echo '<td>£' . number_format( $objProductQuote->Figures->TotalCashPrice, '2', '.', ',' ) . '</td>';
												echo '<td>£' . number_format( $objProductQuote->Figures->Advance, '2', '.', ',' ) . '</td>';
												echo '<td>£' . number_format( $objProductQuote->Figures->InterestCharges, '2', '.', ',' ) . '</td>';
												echo '<td>£' . number_format( $objProductQuote->Figures->AcceptanceFee, '2', '.', ',' ) . '</td>';
												/*if( $objProductQuote->FacilityType != 'HP' ) {*/
													echo '<td>£' . number_format( $objProductQuote->Figures->OptionToPurchaseFee, '2', '.', ',' ) . '</td>';
												/*} else {
													echo '<td>N/A</td>';
												}*/
												echo '<td>£' . number_format( $objProductQuote->Figures->TotalCharges, '2', '.', ',' ) . '</td>';
												echo '<td>£' . number_format( $objProductQuote->Figures->TotalPayable, '2', '.', ',' ) . '</td>';
												echo '<td><strong>£' . number_format( $objProductQuote->Figures->RegularPayment, '2', '.', ',' ) . '</strong></td>';
												echo '<td>£' . number_format( $objProductQuote->Figures->FinalPayment, '2', '.', ',' ) . '</td>';
												
											echo '</tr>';
										
										/*foreach ($objProductQuote->Commissions->Commission as $objCommission)
										{
											printf("<tr><td colspan=2>&nbsp;</td></tr>");
											printf("<tr><td>Commission:</td><td>&pound;
%01.2f</td></tr>", $objCommission->Amount);
                                                											printf("<tr><td>Volume Bonus: </td><td>&pound;
%01.2f</td></tr>", $objCommission->VolumeBonus);											
                                                										}
                                                										
                                                										printf("</table>");
*/
			 			 			}
			 			 		}
			 			 	}
			 			}										
			 		}
			 	}
			}				
		}
		else
		{
			printf("<h2>No Quote Responses</h2>");
		}
			if( $i == 0 ) {
				echo '<tr><td colspan="13">We are sorry but we could not provide an automatic quote.  Contact us, and we may be able to provide a tailored quote.</td></tr>';
			}
	
			echo '</tbody>';
		echo '</table>';
			
		//TODO: Implement business logic to consume $objQuoteResponse, which is of type GetQuotesResponse
	
		if($debug)
		{
			printf("<p>Request headers:<pre>%s</pre></p>",htmlentities($QWv2Client->__getLastRequestHeaders()));
			printf("<p>Request:<pre>%s</pre></p>",htmlentities($QWv2Client->__getLastRequest()));
			printf("<p>Response headers:<pre>%s</pre></p>",htmlentities($QWv2Client->__getLastResponseHeaders()));
			printf("<p>Response:<pre>%s</pre></p>",htmlentities($QWv2Client->__getLastResponse()));
		}
		
	
	}
	catch (Exception $e)
	{
		printf("<p>Exception Message: <pre>%s</pre></p>", $e->getMessage());
	}
?>