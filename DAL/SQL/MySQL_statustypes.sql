/*
Author:			This code was generated by DALGen version 1.0.0.0 available at https://github.com/H0r53/DALGen 
Date:			10/18/2017
Description:	Creates the statustypes table and respective stored procedures

*/


USE smithadb;



--------------------------------------------------------------
-- Create table
--------------------------------------------------------------



CREATE TABLE `smithadb`.`statustypes` (
StatusTypeID INT AUTO_INCREMENT,
Status VARCHAR(255),
Description VARCHAR(1025),
CONSTRAINT pk_statustypes_StatusTypeID PRIMARY KEY (StatusTypeID)
);


--------------------------------------------------------------
-- Create default SCRUD sprocs for this table
--------------------------------------------------------------


DELIMITER //
CREATE PROCEDURE `smithadb`.`usp_statustypes_Load`
(
	 IN paramStatusTypeID INT
)
BEGIN
	SELECT
		`statustypes`.`StatusTypeID` AS `StatusTypeID`,
		`statustypes`.`Status` AS `Status`,
		`statustypes`.`Description` AS `Description`
	FROM `statustypes`
	WHERE 		`statustypes`.`StatusTypeID` = paramStatusTypeID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `smithadb`.`usp_statustypes_LoadAll`()
BEGIN
	SELECT
		`statustypes`.`StatusTypeID` AS `StatusTypeID`,
		`statustypes`.`Status` AS `Status`,
		`statustypes`.`Description` AS `Description`
	FROM `statustypes`;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `smithadb`.`usp_statustypes_Add`
(
	 IN paramStatus VARCHAR(255),
	 IN paramDescription VARCHAR(1025)
)
BEGIN
	INSERT INTO `statustypes` (Status,Description)
	VALUES (paramStatus, paramDescription);
	-- Return last inserted ID as result
	SELECT LAST_INSERT_ID() as id;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `smithadb`.`usp_statustypes_Update`
(
	IN paramStatusTypeID INT,
	IN paramStatus VARCHAR(255),
	IN paramDescription VARCHAR(1025)
)
BEGIN
	UPDATE `statustypes`
	SET Status = paramStatus
		,Description = paramDescription
	WHERE		`statustypes`.`StatusTypeID` = paramStatusTypeID;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `smithadb`.`usp_statustypes_Delete`
(
	IN paramStatusTypeID INT
)
BEGIN
	DELETE FROM `statustypes`
	WHERE		`statustypes`.`StatusTypeID` = paramStatusTypeID;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `smithadb`.`usp_statustypes_Search`
(
	IN paramStatusTypeID INT,
	IN paramStatus VARCHAR(255),
	IN paramDescription VARCHAR(1025)
)
BEGIN
	SELECT
		`statustypes`.`StatusTypeID` AS `StatusTypeID`,
		`statustypes`.`Status` AS `Status`,
		`statustypes`.`Description` AS `Description`
	FROM `statustypes`
	WHERE
		COALESCE(statustypes.`StatusTypeID`,0) = COALESCE(paramStatusTypeID,statustypes.`StatusTypeID`,0)
		AND COALESCE(statustypes.`Status`,'') = COALESCE(paramStatus,statustypes.`Status`,'')
		AND COALESCE(statustypes.`Description`,'') = COALESCE(paramDescription,statustypes.`Description`,'');
END //
DELIMITER ;


