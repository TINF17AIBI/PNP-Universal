CREATE DATABASE [PnP]

GO

USE [PnP]

GO

CREATE TABLE [dbo].[User]
(
	[Id] INT NOT NULL PRIMARY KEY, 
    [Username] NVARCHAR(50) NOT NULL, 
    [Email] NVARCHAR(50) NOT NULL, 
    [Passwort] NVARCHAR(50) NOT NULL
)

CREATE TABLE [dbo].[Templates]
(
	[Id] INT NOT NULL PRIMARY KEY, 
    [Creator] INT NOT NULL FOREIGN KEY (Id) REFERENCES [dbo].[User], 
    [Rules] NVARCHAR(50) NOT NULL, 
)
CREATE TABLE [dbo].[Adventure]
(
	[Id] INT NOT NULL PRIMARY KEY,
	[Name] NVARCHAR(50) NOT NULL,
	[Gamemaster] INT NOT NULL FOREIGN KEY (Id) REFERENCES [dbo].[User],
	[Template] INT NOT NULL FOREIGN KEY (Id) REFERENCES [dbo].[Templates]
)
CREATE TABLE [dbo].[Hero]
(
	[Id] INT NOT NULL PRIMARY KEY,
	[Name] NVARCHAR(50) NOT NULL,
	[Owner] INT NOT NULL FOREIGN KEY (Id) REFERENCES [dbo].[User],
	[Template] INT NOT NULL FOREIGN KEY (Id) REFERENCES [dbo].[Templates],
	[Adventure] INT FOREIGN KEY (Id) REFERENCES [dbo].[Adventure],
	[Stats] NVARCHAR(50) NOT NULL,
	[Inventory] NVARCHAR(50) NOT NULL
)
