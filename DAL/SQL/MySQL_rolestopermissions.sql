/*
Author:			This code was generated by DALGen version 1.0.0.0 available at https://github.com/H0r53/DALGen 
Date:			10/24/2017
Description:	Creates the rolestopermissions table and respective stored procedures

*/


USE smithadb;



--------------------------------------------------------------
-- Create table
--------------------------------------------------------------



CREATE TABLE `smithadb`.`rolestopermissions` (
RoleToPermissionID INT AUTO_INCREMENT,
RoleID INT,
PermissionID INT,
CONSTRAINT pk_rolestopermissions_RoleToPermissionID PRIMARY KEY (RoleToPermissionID)
);


--------------------------------------------------------------
-- Create default SCRUD sprocs for this table
--------------------------------------------------------------


DELIMITER //
CREATE PROCEDURE `smithadb`.`usp_rolestopermissions_Load`
(
	 IN paramRoleToPermissionID INT
)
BEGIN
	SELECT
		`rolestopermissions`.`RoleToPermissionID` AS `RoleToPermissionID`,
		`rolestopermissions`.`RoleID` AS `RoleID`,
		`rolestopermissions`.`PermissionID` AS `PermissionID`
	FROM `rolestopermissions`
	WHERE 		`rolestopermissions`.`RoleToPermissionID` = paramRoleToPermissionID;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `smithadb`.`usp_rolestopermissions_LoadAll`()
BEGIN
	SELECT
		`rolestopermissions`.`RoleToPermissionID` AS `RoleToPermissionID`,
		`rolestopermissions`.`RoleID` AS `RoleID`,
		`rolestopermissions`.`PermissionID` AS `PermissionID`
	FROM `rolestopermissions`;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE `smithadb`.`usp_rolestopermissions_Add`
(
	 IN paramRoleID INT,
	 IN paramPermissionID INT
)
BEGIN
	INSERT INTO `rolestopermissions` (RoleID,PermissionID)
	VALUES (paramRoleID, paramPermissionID);
	-- Return last inserted ID as result
	SELECT LAST_INSERT_ID() as id;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `smithadb`.`usp_rolestopermissions_Update`
(
	IN paramRoleToPermissionID INT,
	IN paramRoleID INT,
	IN paramPermissionID INT
)
BEGIN
	UPDATE `rolestopermissions`
	SET RoleID = paramRoleID
		,PermissionID = paramPermissionID
	WHERE		`rolestopermissions`.`RoleToPermissionID` = paramRoleToPermissionID;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `smithadb`.`usp_rolestopermissions_Delete`
(
	IN paramRoleToPermissionID INT
)
BEGIN
	DELETE FROM `rolestopermissions`
	WHERE		`rolestopermissions`.`RoleToPermissionID` = paramRoleToPermissionID;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `smithadb`.`usp_rolestopermissions_Search`
(
	IN paramRoleToPermissionID INT,
	IN paramRoleID INT,
	IN paramPermissionID INT
)
BEGIN
	SELECT
		`rolestopermissions`.`RoleToPermissionID` AS `RoleToPermissionID`,
		`rolestopermissions`.`RoleID` AS `RoleID`,
		`rolestopermissions`.`PermissionID` AS `PermissionID`
	FROM `rolestopermissions`
	WHERE
		COALESCE(rolestopermissions.`RoleToPermissionID`,0) = COALESCE(paramRoleToPermissionID,rolestopermissions.`RoleToPermissionID`,0)
		AND COALESCE(rolestopermissions.`RoleID`,0) = COALESCE(paramRoleID,rolestopermissions.`RoleID`,0)
		AND COALESCE(rolestopermissions.`PermissionID`,0) = COALESCE(paramPermissionID,rolestopermissions.`PermissionID`,0);
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE `smithadb`.`usp_rolestopermissions_LoadByRoleID`
(
	 IN paramRoleID INT
)
BEGIN
	SELECT
		`rolestopermissions`.`RoleToPermissionID` AS `RoleToPermissionID`,
		`rolestopermissions`.`RoleID` AS `RoleID`,
		`rolestopermissions`.`PermissionID` AS `PermissionID`
	FROM `rolestopermissions`
	WHERE 		`rolestopermissions`.`RoleID` = paramRoleID;
END //
DELIMITER ;