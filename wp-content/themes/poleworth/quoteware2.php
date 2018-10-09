<?php

class GetQuotes {

    public $Credentials;
    public $QuoteRequests;

}

class Credentials {

    public $Password;
    public $Username;

}

class ArrayOfQuoteRequest {

    public $QuoteRequest;

}

class QuoteRequest {

    public $GlobalRequestParameters;

    public $GlobalRequestSettings;

    public $ProductRequestUID;

    public $QuoteeUID;

    public $Requests;

}

class RequestParameters {

    public $Commission;

    public $CommissionType;

    public $ComputationPath;

    public $Rate;

    public $RateType;

    public $Term;

    public $TermUnit;

}

class RequestSettings {

    /**
     * @var boolean
     */
    public $AllowAdjustments;

    /**
     * @var boolean
     */
    public $IncludeRequest;

    /**
     * @var string
     *     NOTE: SortBy should follow the following restrictions
     *     You can have one of the following value
     *     Default
     *     Commission
     *     Payment
     *     APR
     */
    public $SortBy;

}

class ArrayOfRequest {

    /**
     * @var array[0, unbounded] of (object)Request
     */
    public $Request;

}

class Request {

    /**
     * @var (object)RequestAsset
     *    Or one of following derived class(es)
     *       RequestAssetMotorVehicle
     */
    public $Asset;

    /**
     * @var (object)RequestFigures
     */
    public $Figures;

    /**
     * @var (object)RequestParameters
     */
    public $RequestParameters;

    /**
     * @var (object)RequestSettings
     */
    public $RequestSettings;

}

class RequestFigures {

    /**
     * @var (object)RequestFiguresAsset
     *    Or one of following derived class(es)
     *       RequestFiguresAssetMotorVehicle
     */
    public $Asset;

    /**
     * @var double
     */
    public $CashDeposit;

    /**
     * @var double
     */
    public $CashPrice;

}

class RequestFiguresAsset {

}

class RequestFiguresAssetMotorVehicle extends RequestFiguresAsset {

    /**
     * @var int
     */
    public $AnnualDistance;

    /**
     * @var double
     */
    public $ManualResidualValue;

    /**
     * @var double
     */
    public $OutstandingSettlement;

    /**
     * @var double
     */
    public $PartExchange;

}

class RequestAsset {

}

class RequestAssetMotorVehicle extends RequestAsset {

    /**
     * @var string
     *     NOTE: Condition should follow the following restrictions
     *     You can have one of the following value
     *     Default
     *     Car
     *     LCV
     *     HGV
     *     MotorBike
     */
    public $Class;
	
    /**
     * @var string
     *     NOTE: Condition should follow the following restrictions
     *     You can have one of the following value
     *     Default
     *     New
     *     Used
     */
    public $Condition;

    /**
     * @var int
     */
    public $CurrentOdometerReading;

    /**
     * @var string
     */
    public $Identity;

    /**
     * @var string
     *     NOTE: IdentityType should follow the following restrictions
     *     You can have one of the following value
     *     Default
     *     VRM
     *     VIN
     *     RVC
     */
    public $IdentityType;

    /**
     * @var dateTime
     */
    public $RegistrationDate;

    /**
     * @var string
     *     NOTE: Source should follow the following restrictions
     *     You can have one of the following value
     *     Default
     *     RegionCurrent
     *     RegionEuropeanUnion
     *     RegionGrey
     */
    public $Source;

	 /**
     * @var string
     */
    public $StockIdentity;
	
	/**
     * @var string
     */
    public $StockLocation;
	
	 /**
     * @var dateTime
     */
    public $StockingDate;	
	
}

class GetQuotesResponse {

    /**
     * @var (object)QuoteResponse
     */
    public $GetQuotesResult;

}

class QuoteResponseBase {

    /**
     * @var (object)Errors
     */
    public $Errors;

    /**
     * @var (object)Warnings
     */
    public $Warnings;

    /**
     * @var boolean
     */
    public $hasErrors;

    /**
     * @var boolean
     */
    public $hasWarnings;

}

class Errors {

    /**
     * @var (object)ArrayOfError
     */
    public $PrivateErrors;

    /**
     * @var (object)ArrayOfError
     */
    public $PublicErrors;

    /**
     * @var boolean
     */
    public $hasPrivateErrors;

    /**
     * @var boolean
     */
    public $hasPublicErrors;

}

class ArrayOfError {

    /**
     * @var array[0, unbounded] of (object)Error
     */
    public $Error;

}

class Error {

    /**
     * @var string
     */
    public $Message;

    /**
     * @var int
     */
    public $Number;

}

class Warnings {

    /**
     * @var (object)ArrayOfWarning
     */
    public $PrivateWarnings;

    /**
     * @var (object)ArrayOfWarning
     */
    public $PublicWarnings;

    /**
     * @var boolean
     */
    public $hasPrivateWarnings;

    /**
     * @var boolean
     */
    public $hasPublicWarnings;

}

class ArrayOfWarning {

    /**
     * @var array[0, unbounded] of (object)Warning
     */
    public $Warning;

}

class Warning {

    /**
     * @var string
     */
    public $Message;

    /**
     * @var int
     */
    public $Number;

}

class QuoteResponse extends QuoteResponseBase {

    /**
     * @var (object)ArrayOfQuoteResult
     */
    public $QuoteResults;

    /**
     * @var string
     */
    public $QuotedResultsUID;

    /**
     * @var string
     */
    public $ResponseUID;

    /**
     * @var boolean
     */
    public $hasQuoteResults;

}

class ArrayOfQuoteResult {

    /**
     * @var array[0, unbounded] of (object)QuoteResult
     */
    public $QuoteResult;

}

class QuoteResult extends QuoteResponseBase {

    /**
     * @var string
     */
    public $ProductRequestUID;

    /**
     * @var (object)QuoteRequest
     */
    public $QuoteRequest;

    /**
     * @var string
     */
    public $QuotedResultUID;

    /**
     * @var string
     */
    public $QuoteeUID;

    /**
     * @var (object)ArrayOfResult
     */
    public $Results;

    /**
     * @var boolean
     */
    public $hasResults;

}

class ArrayOfResult {

    /**
     * @var array[0, unbounded] of (object)Result
     */
    public $Result;

}

class Result extends QuoteResponseBase {

    /**
     * @var (object)ResultAsset
     *    Or one of following derived class(es)
     *       ResultAssetMotorVehicle
     */
    public $Asset;

    /**
     * @var (object)ArrayOfProductGroup
     */
    public $ProductGroups;

    /**
     * @var string
     */
    public $ProductPackageUID;

    /**
     * @var string
     */
    public $QuotedProductPackageUID;

    /**
     * @var (object)Request
     */
    public $Request;

    /**
     * @var string
     */
    public $ResultUID;

    /**
     * @var boolean
     */
    public $hasProductGroup;

}

class ArrayOfProductGroup {

    /**
     * @var array[0, unbounded] of (object)ProductGroup
     */
    public $ProductGroup;

}

class ProductGroup extends QuoteResponseBase {

    /**
     * @var string
     *     NOTE: FacilityType should follow the following restrictions
     *     You can have one of the following value
     *     Default
     *     HP
     *     PCP
     *     LP
     *     CS
     *     SC
     *     FS
     *     PCH
     *     CH
     *     FL
     *     OL
     *     CP
     *     BP
     */
    public $FacilityType;

    /**
     * @var string
     */
    public $ProductGroupUID;

    /**
     * @var (object)ArrayOfProductQuote
     */
    public $ProductQuotes;

    /**
     * @var string
     */
    public $QuotedProductGroupUID;

    /**
     * @var boolean
     */
    public $hasProductQuote;

}

class ArrayOfProductQuote {

    /**
     * @var array[0, unbounded] of (object)ProductQuote
     */
    public $ProductQuote;

}

class ProductQuote extends QuoteResponseBase {

    /**
     * @var (object)ArrayOfCommission
     */
    public $Commissions;

    /**
     * @var dateTime
     */
    public $ExpiryDate;

    /**
     * @var string
     *     NOTE: FacilityType should follow the following restrictions
     *     You can have one of the following value
     *     Default
     *     HP
     *     PCP
     *     LP
     *     CS
     *     SC
     *     FS
     *     PCH
     *     CH
     *     FL
     *     OL
     *     CP
     *     BP
     */
    public $FacilityType;

    /**
     * @var (object)ProductQuoteFigures
     */
    public $Figures;

    /**
     * @var string
     */
    public $ProductName;

    /**
     * @var string
     */
    public $ProductUID;

    /**
     * @var string
     */
    public $QuoteUID;

    /**
     * @var dateTime
     */
    public $QuotedDateTime;

}

class ArrayOfCommission {

    /**
     * @var array[0, unbounded] of (object)Commission
     */
    public $Commission;

}

class Commission {

    /**
     * @var double
     */
    public $Amount;

    /**
     * @var double
     */
    public $VolumeBonus;

}

class ProductQuoteFigures {

    /**
     * @var double
     */
    public $AER;

    /**
     * @var double
     */
    public $APR;

    /**
     * @var double
     */
    public $AcceptanceFee;

    /**
     * @var double
     */
    public $Advance;

    /**
     * @var (object)ProductQuoteAsset
     *    Or one of following derived class(es)
     *       ProductQuoteAssetMotorVehicle
     */
    public $Asset;

    /**
     * @var double
     */
    public $Ballon;

    /**
     * @var double
     */
    public $BaseRate;

    /**
     * @var double
     */
    public $CustomerRate;

    /**
     * @var (object)ArrayOfEarlySettlement
     */
    public $EarlySettlements;

    /**
     * @var double
     */
    public $FinalPayment;

    /**
     * @var double
     */
    public $FirstPayment;

    /**
     * @var double
     */
    public $InterestCharges;

	/**
     * @var double
     */
    public $InterestRate;
	
    /**
     * @var int
     */
    public $NumberOfRegularPayments;

    /**
     * @var double
     */
    public $OptionToPurchaseFee;

    /**
     * @var double
     */
    public $RegularPayment;

    /**
     * @var double
     */
    public $Repossession;

    /**
     * @var double
     */
    public $Subsidy;

    /**
     * @var int
     */
    public $Term;

    /**
     * @var string
     *     NOTE: TermUnit should follow the following restrictions
     *     You can have one of the following value
     *     Default
     *     Months
     *     Weeks
     */
    public $TermUnit;

    /**
     * @var double
     */
    public $Termination;

    /**
     * @var double
     */
    public $TotalCashPrice;

    /**
     * @var double
     */
    public $TotalCharges;

    /**
     * @var double
     */
    public $TotalDeposit;

    /**
     * @var double
     */
    public $TotalPayable;

}

class ArrayOfEarlySettlement {

    /**
     * @var array[0, unbounded] of (object)EarlySettlement
     */
    public $EarlySettlement;

}

class EarlySettlement {

    /**
     * @var double
     */
    public $Amount;

    /**
     * @var string
     *     NOTE: EarlySettlementType should follow the following restrictions
     *     You can have one of the following value
     *     None
     *     Third
     *     Half
     *     ThreeQuaters
     */
    public $EarlySettlementType;

}

class ProductQuoteAsset {

}

class ProductQuoteAssetMotorVehicle extends ProductQuoteAsset {

    /**
     * @var int
     */
    public $AnnualDistanceQuoted;

    /**
     * @var double
     */
    public $ChargePerOverDistanceUnit;

    /**
     * @var string
     */
    public $RVDataSet;

    /**
     * @var double
     */
    public $RVPercentageUsed;

}

class ResultAsset {

}

class ResultAssetMotorVehicle extends ResultAsset {

    /**
     * @var int
     */
    public $Age;

    /**
     * @var string
     */
    public $AgeIdentifier;

    /**
     * @var string
     *     NOTE: AgeUnit should follow the following restrictions
     *     You can have one of the following value
     *     Default
     *     Months
     *     Weeks
     */
    public $AgeUnit;

    /**
     * @var string
     *     NOTE: Condition should follow the following restrictions
     *     You can have one of the following value
     *     Default
     *     New
     *     Used
     */
    public $Condition;

    /**
     * @var int
     */
    public $CurrentOdometerReading;

    /**
     * @var string
     */
    public $Identity;

    /**
     * @var string
     *     NOTE: IdentityType should follow the following restrictions
     *     You can have one of the following value
     *     Default
     *     VRM
     *     VIN
     *     RVC
     */
    public $IdentityType;

    /**
     * @var dateTime
     */
    public $RegistrationDate;

	 /**
     * @var string
     */
    public $RegistrationMark;
	
    /**
     * @var string
     */
    public $StockIdentity;	
	
    /**
     * @var int
     */
    public $TermDistance;

}

// define the class map
$class_map = array(
    "GetQuotes" => "GetQuotes",
    "Credentials" => "Credentials",
    "ArrayOfQuoteRequest" => "ArrayOfQuoteRequest",
    "QuoteRequest" => "QuoteRequest",
    "RequestParameters" => "RequestParameters",
    "RequestSettings" => "RequestSettings",
    "ArrayOfRequest" => "ArrayOfRequest",
    "Request" => "Request",
    "RequestAsset" => "RequestAsset",
    "RequestAssetMotorVehicle" => "RequestAssetMotorVehicle",
    "RequestFigures" => "RequestFigures",
    "RequestFiguresAsset" => "RequestFiguresAsset",
    "RequestFiguresAssetMotorVehicle" => "RequestFiguresAssetMotorVehicle",
    "GetQuotesResponse" => "GetQuotesResponse",
    "QuoteResponseBase" => "QuoteResponseBase",
    "Errors" => "Errors",
    "ArrayOfError" => "ArrayOfError",
    "Error" => "Error",
    "Warnings" => "Warnings",
    "ArrayOfWarning" => "ArrayOfWarning",
    "Warning" => "Warning",
    "QuoteResponse" => "QuoteResponse",
    "ArrayOfQuoteResult" => "ArrayOfQuoteResult",
    "QuoteResult" => "QuoteResult",
    "ArrayOfResult" => "ArrayOfResult",
    "Result" => "Result",
    "ResultAsset" => "ResultAsset",
    "ResultAssetMotorVehicle" => "ResultAssetMotorVehicle",
    "ArrayOfProductGroup" => "ArrayOfProductGroup",
    "ProductGroup" => "ProductGroup",
    "ArrayOfProductQuote" => "ArrayOfProductQuote",
    "ProductQuote" => "ProductQuote",
    "ArrayOfCommission" => "ArrayOfCommission",
    "Commission" => "Commission",
    "ProductQuoteFigures" => "ProductQuoteFigures",
    "ProductQuoteAsset" => "ProductQuoteAsset",
    "ProductQuoteAssetMotorVehicle" => "ProductQuoteAssetMotorVehicle",
    "ArrayOfEarlySettlement" => "ArrayOfEarlySettlement",
    "EarlySettlement" => "EarlySettlement");

?>
