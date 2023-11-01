<?php

$root = $_SERVER['DOCUMENT_ROOT'];

require_once("{$root}/src/models/DatabaseConnection.php");

class Travel {
    private $id;
    private $userId;
    private $vehicleId;
    private $latitudeOrigin;
    private $longitudeOrigin;
    private $latitudeDestination;
    private $longitudeDestination;
    private $arrivalTime;
    private $hasArrived;
    private $active;
    private $creationDateTime;
    private $updateDateTime;

    public function __construct(
        $userId = null,
        $vehicleId = null,
        $latitudeOrigin = null,
        $longitudeOrigin = null,
        $latitudeDestination = null,
        $longitudeDestination = null,
        $arrivalTime = null,
        $hasArrived = 'False',
        $active = 'True'
    ) {
        $this->userId = $userId;
        $this->vehicleId = $vehicleId;
        $this->latitudeOrigin = $latitudeOrigin;
        $this->longitudeOrigin = $longitudeOrigin;
        $this->latitudeDestination = $latitudeDestination;
        $this->longitudeDestination = $longitudeDestination;
        $this->arrivalTime = $arrivalTime;
        $this->hasArrived = $hasArrived;
        $this->active = $active;
        $this->creationDateTime = new DateTime();
        $this->updateDateTime = new DateTime();
    }

    public static function registerTravel($travelData){
        try {
            $databaseConnection = DatabaseConnection::getConnectedInstance();
            $travel = new Travel(
                $travelData['UserId'],
                $travelData['VehicleId'],
                $travelData['LatitudeOrigin'],
                $travelData['LongitudeOrigin'],
                $travelData['LatitudeDestination'],
                $travelData['LongitudeDestination'],
                $travelData['ArrivalTime']
            );
            $sql = "INSERT INTO `Travels`(`UserId`, `VehicleId`, `LatitudeOrigin`, `LongitudeOrigin`, `LatitudeDestination`, `LongitudeDestination`, `ArrivalTime`) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
            $preparedQuery = $databaseConnection->prepare($sql);
            $preparedQuery->bind_param(
                'iisssss', 
                $travel->userId, 
                $travel->vehicleId,
                $travel->latitudeOrigin,
                $travel->longitudeOrigin,
                $travel->latitudeDestination,
                $travel->longitudeDestination,
                $travel->arrivalTime
            );
            $preparedQuery->execute();

            header("Content-Type: application/json");
            echo json_encode(['message' => 'El viaje se registró exitosamente']);

        } catch (Exception $e) {
            http_response_code(500);
            echo $e->getMessage();
        } finally {
            $preparedQuery->close();
        }
    }
    
}