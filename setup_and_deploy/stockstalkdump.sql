-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2016 at 03:09 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `loginInfo`
--

CREATE TABLE IF NOT EXISTS `loginInfo` (
  `username` varchar(40) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `hashpass` varchar(255) DEFAULT NULL,
  `salt` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE IF NOT EXISTS `portfolio` (
  `username` varchar(25) NOT NULL,
  `ticker` varchar(10) NOT NULL,
  `amount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `search_history`
--

CREATE TABLE IF NOT EXISTS `search_history` (
  `searchID` int(10) UNSIGNED NOT NULL,
  `search_date` datetime NOT NULL,
  `search_type` varchar(25) NOT NULL,
  `search_parameter` varchar(1500) NOT NULL,
  `filepath` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
  `ticker` varchar(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `sector` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`ticker`, `name`, `sector`) VALUES
('A', 'Agilent Technologies Inc', 'Health Care'),
('AA', 'Alcoa Inc', 'Materials'),
('AAL', 'American Airlines Group', 'Industrials'),
('AAP', 'Advance Auto Parts', 'Consumer Discretionary'),
('AAPL', 'Apple Inc.', 'Information Technology'),
('ABBV', 'AbbVie', 'Health Care'),
('ABC', 'AmerisourceBergen Corp', 'Health Care'),
('ABT', 'Abbott Laboratories', 'Health Care'),
('ACN', 'Accenture plc', 'Information Technology'),
('ADBE', 'Adobe Systems Inc', 'Information Technology'),
('ADI', 'Analog Devices, Inc.', 'Information Technology'),
('ADM', 'Archer-Daniels-Midland Co', 'Consumer Staples'),
('ADP', 'Automatic Data Processing', 'Information Technology'),
('ADS', 'Alliance Data Systems', 'Information Technology'),
('ADSK', 'Autodesk Inc', 'Information Technology'),
('ADT', 'ADT Corp', 'Industrials'),
('AEE', 'Ameren Corp', 'Utilities'),
('AEP', 'American Electric Power', 'Utilities'),
('AES', 'AES Corp', 'Utilities'),
('AET', 'Aetna Inc', 'Health Care'),
('AFL', 'AFLAC Inc', 'Financials'),
('AGN', 'Allergan plc', 'Health Care'),
('AIG', 'American International Group, Inc.', 'Financials'),
('AIV', 'Apartment Investment & Mgmt', 'Financials'),
('AIZ', 'Assurant Inc', 'Financials'),
('AKAM', 'Akamai Technologies Inc', 'Information Technology'),
('ALL', 'Allstate Corp', 'Financials'),
('ALLE', 'Allegion', 'Industrials'),
('ALXN', 'Alexion Pharmaceuticals', 'Health Care'),
('AMAT', 'Applied Materials Inc', 'Information Technology'),
('AME', 'Ametek', 'Industrials'),
('AMG', 'Affiliated Managers Group Inc', 'Financials'),
('AMGN', 'Amgen Inc', 'Health Care'),
('AMP', 'Ameriprise Financial', 'Financials'),
('AMT', 'American Tower Corp A', 'Financials'),
('AMZN', 'Amazon.com Inc', 'Consumer Discretionary'),
('AN', 'AutoNation Inc', 'Consumer Discretionary'),
('ANTM', 'Anthem Inc.', 'Health Care'),
('AON', 'Aon plc', 'Financials'),
('APA', 'Apache Corporation', 'Energy'),
('APC', 'Anadarko Petroleum Corp', 'Energy'),
('APD', 'Air Products & Chemicals Inc', 'Materials'),
('APH', 'Amphenol Corp A', 'Industrials'),
('ARG', 'Airgas Inc', 'Materials'),
('ATVI', 'Activision Blizzard', 'Information Technology'),
('AVB', 'AvalonBay Communities, Inc.', 'Financials'),
('AVGO', 'Avago Technologies', 'Information Technology'),
('AVY', 'Avery Dennison Corp', 'Materials'),
('AWK', 'American Water Works Company Inc', 'Utilities'),
('AXP', 'American Express Co', 'Financials'),
('AZO', 'AutoZone Inc', 'Consumer Discretionary'),
('BA', 'Boeing Company', 'Industrials'),
('BAC', 'Bank of America Corp', 'Financials'),
('BAX', 'Baxter International Inc.', 'Health Care'),
('BBBY', 'Bed Bath & Beyond', 'Consumer Discretionary'),
('BBT', 'BB&T Corporation', 'Financials'),
('BBY', 'Best Buy Co. Inc.', 'Consumer Discretionary'),
('BCR', 'Bard (C.R.) Inc.', 'Health Care'),
('BDX', 'Becton Dickinson', 'Health Care'),
('BEN', 'Franklin Resources', 'Financials'),
('BF-B', 'Brown-Forman Corporation', 'Consumer Staples'),
('BHI', 'Baker Hughes Inc', 'Energy'),
('BIIB', 'BIOGEN IDEC Inc.', 'Health Care'),
('BK', 'The Bank of New York Mellon Corp.', 'Financials'),
('BLK', 'BlackRock', 'Financials'),
('BLL', 'Ball Corp', 'Materials'),
('BMY', 'Bristol-Myers Squibb', 'Health Care'),
('BRK-B', 'Berkshire Hathaway', 'Financials'),
('BSX', 'Boston Scientific', 'Health Care'),
('BWA', 'BorgWarner', 'Consumer Discretionary'),
('BXLT', 'Baxalta', 'Health Care'),
('BXP', 'Boston Properties', 'Financials'),
('C', 'Citigroup Inc.', 'Financials'),
('CA', 'CA, Inc.', 'Information Technology'),
('CAG', 'ConAgra Foods Inc.', 'Consumer Staples'),
('CAH', 'Cardinal Health Inc.', 'Health Care'),
('CAM', 'Camellia PLC', 'Consumer Staples'),
('CAT', 'Caterpillar Inc.', 'Industrials'),
('CB', 'Chubb Limited', 'Financials'),
('CBG', 'CBRE Group', 'Financials'),
('CBS', 'CBS Corp.', 'Consumer Discretionary'),
('CCE', 'Coca-Cola Enterprises', 'Consumer Staples'),
('CCI', 'Crown Castle International Corp.', 'Financials'),
('CCL', 'Carnival Corp.', 'Consumer Discretionary'),
('CELG', 'Celgene Corp.', 'Health Care'),
('CERN', 'Cerner', 'Health Care'),
('CF', 'CF Industries Holdings Inc', 'Materials'),
('CFG', 'Citizens Financial Group', 'Financials'),
('CHD', 'Church & Dwight', 'Consumer Staples'),
('CHK', 'Chesapeake Energy', 'Energy'),
('CHRW', 'C. H. Robinson Worldwide', 'Industrials'),
('CI', 'CIGNA Corp.', 'Health Care'),
('CINF', 'Cincinnati Financial', 'Financials'),
('CL', 'Colgate-Palmolive', 'Consumer Staples'),
('CLX', 'The Clorox Company', 'Consumer Staples'),
('CMA', 'Comerica Inc.', 'Financials'),
('CMCSA', 'Comcast A Corp', 'Consumer Discretionary'),
('CME', 'CME Group Inc.', 'Financials'),
('CMG', 'Chipotle Mexican Grill', 'Consumer Discretionary'),
('CMI', 'Cummins Inc.', 'Industrials'),
('CMS', 'CMS Energy', 'Utilities'),
('CNC', 'Centene Corporation', 'Health Care'),
('CNP', 'CenterPoint Energy', 'Utilities'),
('CNX', 'Consol Energy Inc.', 'Energy'),
('COF', 'Capital One Financial', 'Financials'),
('COG', 'Cabot Oil & Gas', 'Energy'),
('COH', 'Coach Inc.', 'Consumer Discretionary'),
('COL', 'Rockwell Collins', 'Industrials'),
('COP', 'ConocoPhillips', 'Energy'),
('COST', 'Costco Co.', 'Consumer Staples'),
('CPB', 'Campbell Soup', 'Consumer Staples'),
('CPGX', 'Columbia Pipeline Group Inc', 'Energy'),
('CRM', 'Salesforce.com', 'Information Technology'),
('CSCO', 'Cisco Systems', 'Information Technology'),
('CSRA', 'CSRA Inc.', 'Information Technology'),
('CSX', 'CSX Corp.', 'Industrials'),
('CTAS', 'Cintas Corporation', 'Industrials'),
('CTL', 'CenturyLink Inc', 'Telecommunications Services'),
('CTSH', 'Cognizant Technology Solutions', 'Information Technology'),
('CTXS', 'Citrix Systems', 'Information Technology'),
('CVC', 'Cablevision Systems Corp.', 'Consumer Discretionary'),
('CVS', 'CVS Health', 'Consumer Staples'),
('CVX', 'Chevron Corp.', 'Energy'),
('CXO', 'Concho Resources', 'Energy'),
('D', 'Dominion Resources', 'Utilities'),
('DAL', 'Delta Air Lines', 'Industrials'),
('DD', 'Du Pont (E.I.)', 'Materials'),
('DE', 'Deere & Co.', 'Industrials'),
('DFS', 'Discover Financial Services', 'Financials'),
('DG', 'Dollar General', 'Consumer Discretionary'),
('DGX', 'Quest Diagnostics', 'Health Care'),
('DHI', 'D. R. Horton', 'Consumer Discretionary'),
('DHR', 'Danaher Corp.', 'Industrials'),
('DIS', 'The Walt Disney Company', 'Consumer Discretionary'),
('DISCA', 'Discovery Communications-A', 'Consumer Discretionary'),
('DISCK', 'Discovery Communications-C', 'Consumer Discretionary'),
('DLPH', 'Delphi Automotive', 'Consumer Discretionary'),
('DLTR', 'Dollar Tree', 'Consumer Discretionary'),
('DNB', 'Dun & Bradstreet', 'Industrials'),
('DO', 'Diamond Offshore Drilling', 'Energy'),
('DOV', 'Dover Corp.', 'Industrials'),
('DOW', 'Dow Chemical', 'Materials'),
('DPS', 'Dr Pepper Snapple Group', 'Consumer Staples'),
('DRI', 'Darden Restaurants', 'Consumer Discretionary'),
('DTE', 'DTE Energy Co.', 'Utilities'),
('DUK', 'Duke Energy', 'Utilities'),
('DVA', 'DaVita Inc.', 'Health Care'),
('DVN', 'Devon Energy Corp.', 'Energy'),
('EA', 'Electronic Arts', 'Information Technology'),
('EBAY', 'eBay Inc.', 'Information Technology'),
('ECL', 'Ecolab Inc.', 'Materials'),
('ED', 'Consolidated Edison', 'Utilities'),
('EFX', 'Equifax Inc.', 'Financials'),
('EIX', 'Edison Int\'l', 'Utilities'),
('EL', 'Estee Lauder Cos.', 'Consumer Staples'),
('EMC', 'EMC Corp.', 'Information Technology'),
('EMN', 'Eastman Chemical', 'Materials'),
('EMR', 'Emerson Electric Company', 'Industrials'),
('ENDP', 'Endo International', 'Health Care'),
('EOG', 'EOG Resources', 'Energy'),
('EQIX', 'Equinix', 'Information Technology'),
('EQR', 'Equity Residential', 'Financials'),
('EQT', 'EQT Corporation', 'Energy'),
('ES', 'Eversource Energy', 'Utilities'),
('ESRX', 'Express Scripts', 'Health Care'),
('ESS', 'Essex Property Trust Inc', 'Financials'),
('ESV', 'Ensco PLC', 'Energy'),
('ETFC', 'E*Trade', 'Financials'),
('ETN', 'Eaton Corporation', 'Industrials'),
('ETR', 'Entergy Corp.', 'Utilities'),
('EW', 'Edwards Lifesciences', 'Health Care'),
('EXC', 'Exelon Corp.', 'Utilities'),
('EXPD', 'Expeditors Int\'l', 'Industrials'),
('EXPE', 'Expedia Inc.', 'Consumer Discretionary'),
('EXR', 'Extra Space Storage', 'Financials'),
('F', 'Ford Motor', 'Consumer Discretionary'),
('FAST', 'Fastenal Co', 'Industrials'),
('FB', 'Facebook', 'Information Technology'),
('FCX', 'Freeport-McMoran Cp & Gld', 'Materials'),
('FDX', 'FedEx Corporation', 'Industrials'),
('FE', 'FirstEnergy Corp', 'Utilities'),
('FFIV', 'F5 Networks', 'Information Technology'),
('FIS', 'Fidelity National Information Services', 'Information Technology'),
('FISV', 'Fiserv Inc', 'Information Technology'),
('FITB', 'Fifth Third Bancorp', 'Financials'),
('FL', 'Foot Locker Inc', 'Consumer Discretionary'),
('FLIR', 'FLIR Systems', 'Industrials'),
('FLR', 'Fluor Corp.', 'Industrials'),
('FLS', 'Flowserve Corporation', 'Industrials'),
('FMC', 'FMC Corporation', 'Materials'),
('FOX', 'Twenty-First Century Fox Class B', 'Consumer Discretionary'),
('FOXA', 'Twenty-First Century Fox Class A', 'Consumer Discretionary'),
('FRT', 'Federal Realty Investment Trust', 'Financials'),
('FSLR', 'First Solar Inc', 'Information Technology'),
('FTI', 'FMC Technologies Inc.', 'Energy'),
('FTR', 'Frontier Communications', 'Telecommunications Services'),
('GAS', 'AGL Resources Inc.', 'Utilities'),
('GD', 'General Dynamics', 'Industrials'),
('GE', 'General Electric', 'Industrials'),
('GGP', 'General Growth Properties Inc.', 'Financials'),
('GILD', 'Gilead Sciences', 'Health Care'),
('GIS', 'General Mills', 'Consumer Staples'),
('GLW', 'Corning Inc.', 'Industrials'),
('GM', 'General Motors', 'Consumer Discretionary'),
('GMCR', 'Keurig Green Mountain', 'Consumer Staples'),
('GME', 'GameStop Corp.', 'Consumer Discretionary'),
('GOOG', 'Alphabet Inc Class C', 'Information Technology'),
('GOOGL', 'Alphabet Inc Class A', 'Information Technology'),
('GPC', 'Genuine Parts', 'Consumer Discretionary'),
('GPS', 'Gap (The)', 'Consumer Discretionary'),
('GRMN', 'Garmin Ltd.', 'Consumer Discretionary'),
('GS', 'Goldman Sachs Group', 'Financials'),
('GT', 'Goodyear Tire & Rubber', 'Consumer Discretionary'),
('GWW', 'Grainger (W.W.) Inc.', 'Industrials'),
('HAL', 'Halliburton Co.', 'Energy'),
('HAR', 'Harman Int\'l Industries', 'Consumer Discretionary'),
('HAS', 'Hasbro Inc.', 'Consumer Discretionary'),
('HBAN', 'Huntington Bancshares', 'Financials'),
('HBI', 'Hanesbrands Inc', 'Consumer Discretionary'),
('HCA', 'HCA Holdings', 'Health Care'),
('HCN', 'Welltower Inc.', 'Financials'),
('HCP', 'HCP Inc.', 'Financials'),
('HD', 'Home Depot', 'Consumer Discretionary'),
('HES', 'Hess Corporation', 'Energy'),
('HIG', 'Hartford Financial Svc.Gp.', 'Financials'),
('HOG', 'Harley-Davidson', 'Consumer Discretionary'),
('HOLX', 'Hologic', 'Health Care'),
('HON', 'Honeywell Int\'l Inc.', 'Industrials'),
('HOT', 'Starwood Hotels & Resorts', 'Consumer Discretionary'),
('HP', 'Helmerich & Payne', 'Energy'),
('HPE', 'Hewlett Packard Enterprise', 'Information Technology'),
('HPQ', 'HP Inc.', 'Information Technology'),
('HRB', 'Block H&R', 'Financials'),
('HRL', 'Hormel Foods Corp.', 'Consumer Staples'),
('HRS', 'Harris Corporation', 'Information Technology'),
('HSIC', 'Henry Schein', 'Health Care'),
('HST', 'Host Hotels & Resorts', 'Financials'),
('HSY', 'The Hershey Company', 'Consumer Staples'),
('HUM', 'Humana Inc.', 'Health Care'),
('IBM', 'International Bus. Machines', 'Information Technology'),
('ICE', 'Intercontinental Exchange', 'Financials'),
('IFF', 'Intl Flavors & Fragrances', 'Materials'),
('ILMN', 'Illumina Inc', 'Health Care'),
('INTC', 'Intel Corp.', 'Information Technology'),
('INTU', 'Intuit Inc.', 'Information Technology'),
('IP', 'International Paper', 'Materials'),
('IPG', 'Interpublic Group', 'Consumer Discretionary'),
('IR', 'Ingersoll-Rand PLC', 'Industrials'),
('IRM', 'Iron Mountain Incorporated', 'Industrials'),
('ISRG', 'Intuitive Surgical Inc.', 'Health Care'),
('ITW', 'Illinois Tool Works', 'Industrials'),
('IVZ', 'Invesco Ltd.', 'Financials'),
('JBHT', 'J. B. Hunt Transport Services', 'Industrials'),
('JCI', 'Johnson Controls', 'Consumer Discretionary'),
('JEC', 'Jacobs Engineering Group', 'Industrials'),
('JNJ', 'Johnson & Johnson', 'Health Care'),
('JNPR', 'Juniper Networks', 'Information Technology'),
('JPM', 'JPMorgan Chase & Co.', 'Financials'),
('JWN', 'Nordstrom', 'Consumer Discretionary'),
('K', 'Kellogg Co.', 'Consumer Staples'),
('KEY', 'KeyCorp', 'Financials'),
('KHC', 'Kraft Heinz Co', 'Consumer Staples'),
('KIM', 'Kimco Realty', 'Financials'),
('KLAC', 'KLA-Tencor Corp.', 'Information Technology'),
('KMB', 'Kimberly-Clark', 'Consumer Staples'),
('KMI', 'Kinder Morgan', 'Energy'),
('KMX', 'Carmax Inc', 'Consumer Discretionary'),
('KO', 'The Coca Cola Company', 'Consumer Staples'),
('KORS', 'Michael Kors Holdings', 'Consumer Discretionary'),
('KR', 'Kroger Co.', 'Consumer Staples'),
('KSS', 'Kohl\'s Corp.', 'Consumer Discretionary'),
('KSU', 'Kansas City Southern', 'Industrials'),
('L', 'Loews Corp.', 'Financials'),
('LB', 'L Brands Inc.', 'Consumer Discretionary'),
('LEG', 'Leggett & Platt', 'Industrials'),
('LEN', 'Lennar Corp.', 'Consumer Discretionary'),
('LH', 'Laboratory Corp. of America Holding', 'Health Care'),
('LLL', 'L-3 Communications Holdings', 'Industrials'),
('LLTC', 'Linear Technology Corp.', 'Information Technology'),
('LLY', 'Lilly (Eli) & Co.', 'Health Care'),
('LM', 'Legg Mason', 'Financials'),
('LMT', 'Lockheed Martin Corp.', 'Industrials'),
('LNC', 'Lincoln National', 'Financials'),
('LOW', 'Lowe\'s Cos.', 'Consumer Discretionary'),
('LRCX', 'Lam Research', 'Information Technology'),
('LUK', 'Leucadia National Corp.', 'Financials'),
('LUV', 'Southwest Airlines', 'Industrials'),
('LVLT', 'Level 3 Communications', 'Telecommunications Services'),
('LYB', 'LyondellBasell', 'Materials'),
('M', 'Macy\'s Inc.', 'Consumer Discretionary'),
('MA', 'Mastercard Inc.', 'Information Technology'),
('MAC', 'Macerich', 'Financials'),
('MAR', 'Marriott Int\'l.', 'Consumer Discretionary'),
('MAS', 'Masco Corp.', 'Industrials'),
('MAT', 'Mattel Inc.', 'Consumer Discretionary'),
('MCD', 'McDonald\'s Corp.', 'Consumer Discretionary'),
('MCHP', 'Microchip Technology', 'Information Technology'),
('MCK', 'McKesson Corp.', 'Health Care'),
('MCO', 'Moody\'s Corp', 'Financials'),
('MDLZ', 'Mondelez International', 'Consumer Staples'),
('MDT', 'Medtronic plc', 'Health Care'),
('MET', 'MetLife Inc.', 'Financials'),
('MHFI', 'McGraw Hill Financial', 'Financials'),
('MHK', 'Mohawk Industries', 'Consumer Discretionary'),
('MJN', 'Mead Johnson', 'Consumer Staples'),
('MKC', 'McCormick & Co.', 'Consumer Staples'),
('MLM', 'Martin Marietta Materials', 'Materials'),
('MMC', 'Marsh & McLennan', 'Financials'),
('MMM', '3M Company', 'Industrials'),
('MNK', 'Mallinckrodt Plc', 'Health Care'),
('MNST', 'Monster Beverage', 'Consumer Staples'),
('MO', 'Altria Group Inc', 'Consumer Staples'),
('MON', 'Monsanto Co.', 'Materials'),
('MOS', 'The Mosaic Company', 'Materials'),
('MPC', 'Marathon Petroleum', 'Energy'),
('MRK', 'Merck & Co.', 'Health Care'),
('MRO', 'Marathon Oil Corp.', 'Energy'),
('MS', 'Morgan Stanley', 'Financials'),
('MSFT', 'Microsoft Corp.', 'Information Technology'),
('MSI', 'Motorola Solutions Inc.', 'Information Technology'),
('MTB', 'M&T Bank Corp.', 'Financials'),
('MU', 'Micron Technology', 'Information Technology'),
('MUR', 'Murphy Oil', 'Energy'),
('MYL', 'Mylan N.V.', 'Health Care'),
('NAVI', 'Navient', 'Financials'),
('NBL', 'Noble Energy Inc', 'Energy'),
('NDAQ', 'NASDAQ OMX Group', 'Financials'),
('NEE', 'NextEra Energy', 'Utilities'),
('NEM', 'Newmont Mining Corp. (Hldg. Co.)', 'Materials'),
('NFLX', 'Netflix Inc.', 'Information Technology'),
('NFX', 'Newfield Exploration Co', 'Energy'),
('NI', 'NiSource Inc.', 'Utilities'),
('NKE', 'Nike', 'Consumer Discretionary'),
('NLSN', 'Nielsen Holdings', 'Industrials'),
('NOC', 'Northrop Grumman Corp.', 'Industrials'),
('NOV', 'National Oilwell Varco Inc.', 'Energy'),
('NRG', 'NRG Energy', 'Utilities'),
('NSC', 'Norfolk Southern Corp.', 'Industrials'),
('NTAP', 'NetApp', 'Information Technology'),
('NTRS', 'Northern Trust Corp.', 'Financials'),
('NUE', 'Nucor Corp.', 'Materials'),
('NVDA', 'Nvidia Corporation', 'Information Technology'),
('NWL', 'Newell Rubbermaid Co.', 'Consumer Discretionary'),
('NWS', 'News Corp. Class B', 'Consumer Discretionary'),
('NWSA', 'News Corp. Class A', 'Consumer Discretionary'),
('O', 'Realty Income Corporation', 'Financials'),
('OI', 'Owens-Illinois Inc', 'Materials'),
('OKE', 'ONEOK', 'Energy'),
('OMC', 'Omnicom Group', 'Consumer Discretionary'),
('ORCL', 'Oracle Corp.', 'Information Technology'),
('ORLY', 'O\'Reilly Automotive', 'Consumer Discretionary'),
('OXY', 'Occidental Petroleum', 'Energy'),
('PAYX', 'Paychex Inc.', 'Information Technology'),
('PBCT', 'People\'s United Financial', 'Financials'),
('PBI', 'Pitney-Bowes', 'Industrials'),
('PCAR', 'PACCAR Inc.', 'Industrials'),
('PCG', 'PG&E Corp.', 'Utilities'),
('PCLN', 'Priceline.com Inc', 'Consumer Discretionary'),
('PDCO', 'Patterson Companies', 'Health Care'),
('PEG', 'Public Serv. Enterprise Inc.', 'Utilities'),
('PEP', 'PepsiCo Inc.', 'Consumer Staples'),
('PFE', 'Pfizer Inc.', 'Health Care'),
('PFG', 'Principal Financial Group', 'Financials'),
('PG', 'Procter & Gamble', 'Consumer Staples'),
('PGR', 'Progressive Corp.', 'Financials'),
('PH', 'Parker-Hannifin', 'Industrials'),
('PHM', 'Pulte Homes Inc.', 'Consumer Discretionary'),
('PKI', 'PerkinElmer', 'Health Care'),
('PLD', 'Prologis', 'Financials'),
('PM', 'Philip Morris International', 'Consumer Staples'),
('PNC', 'PNC Financial Services', 'Financials'),
('PNR', 'Pentair Ltd.', 'Industrials'),
('PNW', 'Pinnacle West Capital', 'Utilities'),
('POM', 'Pepco Holdings Inc.', 'Energy'),
('PPG', 'PPG Industries', 'Materials'),
('PPL', 'PPL Corp.', 'Utilities'),
('PRGO', 'Perrigo', 'Health Care'),
('PRU', 'Prudential Financial', 'Financials'),
('PSA', 'Public Storage', 'Financials'),
('PSX', 'Phillips 66', 'Energy'),
('PVH', 'PVH Corp.', 'Consumer Discretionary'),
('PWR', 'Quanta Services Inc.', 'Industrials'),
('PX', 'Praxair Inc.', 'Materials'),
('PXD', 'Pioneer Natural Resources', 'Energy'),
('PYPL', 'PayPal', 'Information Technology'),
('QCOM', 'QUALCOMM Inc.', 'Information Technology'),
('QRVO', 'Qorvo', 'Information Technology'),
('R', 'Ryder System', 'Industrials'),
('RAI', 'Reynolds American Inc.', 'Consumer Staples'),
('RCL', 'Royal Caribbean Cruises Ltd', 'Consumer Discretionary'),
('REGN', 'Regeneron', 'Health Care'),
('RF', 'Regions Financial Corp.', 'Financials'),
('RHI', 'Robert Half International', 'Industrials'),
('RHT', 'Red Hat Inc.', 'Information Technology'),
('RIG', 'Transocean', 'Energy'),
('RL', 'Polo Ralph Lauren Corp.', 'Consumer Discretionary'),
('ROK', 'Rockwell Automation Inc.', 'Industrials'),
('ROP', 'Roper Industries', 'Industrials'),
('ROST', 'Ross Stores', 'Consumer Discretionary'),
('RRC', 'Range Resources Corp.', 'Energy'),
('RSG', 'Republic Services Inc', 'Industrials'),
('RTN', 'Raytheon Co.', 'Industrials'),
('SBUX', 'Starbucks Corp.', 'Consumer Discretionary'),
('SCG', 'SCANA Corp', 'Utilities'),
('SCHW', 'Charles Schwab Corporation', 'Financials'),
('SE', 'Spectra Energy Corp.', 'Energy'),
('SEE', 'Sealed Air Corp.(New)', 'Materials'),
('SHW', 'Sherwin-Williams', 'Materials'),
('SIG', 'Signet Jewelers', 'Consumer Discretionary'),
('SJM', 'Smucker (J.M.)', 'Consumer Staples'),
('SLB', 'Schlumberger Ltd.', 'Energy'),
('SLG', 'SL Green Realty', 'Financials'),
('SNA', 'Snap-On Inc.', 'Consumer Discretionary'),
('SNDK', 'SanDisk Corporation', 'Information Technology'),
('SNI', 'Scripps Networks Interactive Inc.', 'Consumer Discretionary'),
('SO', 'Southern Co.', 'Utilities'),
('SPG', 'Simon Property Group Inc', 'Financials'),
('SPLS', 'Staples Inc.', 'Consumer Discretionary'),
('SRCL', 'Stericycle Inc', 'Industrials'),
('SRE', 'Sempra Energy', 'Utilities'),
('STI', 'SunTrust Banks', 'Financials'),
('STJ', 'St Jude Medical', 'Health Care'),
('STT', 'State Street Corp.', 'Financials'),
('STX', 'Seagate Technology', 'Information Technology'),
('STZ', 'Constellation Brands', 'Consumer Staples'),
('SWK', 'Stanley Black & Decker', 'Consumer Discretionary'),
('SWKS', 'Skyworks Solutions', 'Information Technology'),
('SWN', 'Southwestern Energy', 'Energy'),
('SYF', 'Synchrony Financial', 'Financials'),
('SYK', 'Stryker Corp.', 'Health Care'),
('SYMC', 'Symantec Corp.', 'Information Technology'),
('SYY', 'Sysco Corp.', 'Consumer Staples'),
('T', 'AT&T Inc', 'Telecommunications Services'),
('TAP', 'Molson Coors Brewing Company', 'Consumer Staples'),
('TDC', 'Teradata Corp.', 'Information Technology'),
('TE', 'TECO Energy', 'Utilities'),
('TEL', 'TE Connectivity Ltd.', 'Information Technology'),
('TGNA', 'Tegna', 'Consumer Discretionary'),
('TGT', 'Target Corp.', 'Consumer Discretionary'),
('THC', 'Tenet Healthcare Corp.', 'Health Care'),
('TIF', 'Tiffany & Co.', 'Consumer Discretionary'),
('TJX', 'TJX Companies Inc.', 'Consumer Discretionary'),
('TMK', 'Torchmark Corp.', 'Financials'),
('TMO', 'Thermo Fisher Scientific', 'Health Care'),
('TRIP', 'TripAdvisor', 'Consumer Discretionary'),
('TROW', 'T. Rowe Price Group', 'Financials'),
('TRV', 'The Travelers Companies Inc.', 'Financials'),
('TSCO', 'Tractor Supply Company', 'Consumer Discretionary'),
('TSN', 'Tyson Foods', 'Consumer Staples'),
('TSO', 'Tesoro Petroleum Co.', 'Energy'),
('TSS', 'Total System Services', 'Information Technology'),
('TWC', 'Time Warner Cable Inc.', 'Consumer Discretionary'),
('TWX', 'Time Warner Inc.', 'Consumer Discretionary'),
('TXN', 'Texas Instruments', 'Information Technology'),
('TXT', 'Textron Inc.', 'Industrials'),
('TYC', 'Tyco International', 'Industrials'),
('UA', 'Under Armour', 'Consumer Discretionary'),
('UAL', 'United Continental Holdings', 'Industrials'),
('UDR', 'UDR Inc', 'Financials'),
('UHS', 'Universal Health Services, Inc.', 'Health Care'),
('UNH', 'United Health Group Inc.', 'Health Care'),
('UNM', 'Unum Group', 'Financials'),
('UNP', 'Union Pacific', 'Industrials'),
('UPS', 'United Parcel Service', 'Industrials'),
('URBN', 'Urban Outfitters', 'Consumer Discretionary'),
('URI', 'United Rentals, Inc.', 'Industrials'),
('USB', 'U.S. Bancorp', 'Financials'),
('UTX', 'United Technologies', 'Industrials'),
('V', 'Visa Inc.', 'Information Technology'),
('VAR', 'Varian Medical Systems', 'Health Care'),
('VFC', 'V.F. Corp.', 'Consumer Discretionary'),
('VIAB', 'Viacom Inc.', 'Consumer Discretionary'),
('VLO', 'Valero Energy', 'Energy'),
('VMC', 'Vulcan Materials', 'Materials'),
('VNO', 'Vornado Realty Trust', 'Financials'),
('VRSK', 'Verisk Analytics', 'Industrials'),
('VRSN', 'Verisign Inc.', 'Information Technology'),
('VRTX', 'Vertex Pharmaceuticals Inc', 'Health Care'),
('VTR', 'Ventas Inc', 'Financials'),
('VZ', 'Verizon Communications', 'Telecommunications Services'),
('WAT', 'Waters Corporation', 'Health Care'),
('WBA', 'Walgreens Boots Alliance', 'Consumer Staples'),
('WDC', 'Western Digital', 'Information Technology'),
('WEC', 'WEC Energy Group Inc', 'Utilities'),
('WFC', 'Wells Fargo', 'Financials'),
('WFM', 'Whole Foods Market', 'Consumer Staples'),
('WHR', 'Whirlpool Corp.', 'Consumer Discretionary'),
('WLTW', 'Willis Towers Watson', 'Financials'),
('WM', 'Waste Management Inc.', 'Industrials'),
('WMB', 'Williams Cos.', 'Energy'),
('WMT', 'Wal-Mart Stores', 'Consumer Staples'),
('WRK', 'Westrock Co', 'Materials'),
('WU', 'Western Union Co', 'Information Technology'),
('WY', 'Weyerhaeuser Corp.', 'Financials'),
('WYN', 'Wyndham Worldwide', 'Consumer Discretionary'),
('WYNN', 'Wynn Resorts Ltd', 'Consumer Discretionary'),
('XEC', 'Cimarex Energy', 'Energy'),
('XEL', 'Xcel Energy Inc', 'Utilities'),
('XL', 'XL Catlin', 'Financials'),
('XLNX', 'Xilinx Inc', 'Information Technology'),
('XOM', 'Exxon Mobil Corp.', 'Energy'),
('XRAY', 'Dentsply Sirona', 'Health Care'),
('XRX', 'Xerox Corp.', 'Information Technology'),
('XYL', 'Xylem Inc.', 'Industrials'),
('YHOO', 'Yahoo Inc.', 'Information Technology'),
('YUM', 'Yum! Brands Inc', 'Consumer Discretionary'),
('ZBH', 'Zimmer Biomet Holdings', 'Health Care'),
('ZION', 'Zions Bancorp', 'Financials'),
('ZTS', 'Zoetis', 'Health Care') ON DUPLICATE KEY UPDATE `ticker` = `ticker`;

-- --------------------------------------------------------

--
-- Table structure for table `userHasSearch`
--

CREATE TABLE `userHasSearch` (
  `username` varchar(40) NOT NULL,
  `searchID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `loginInfo`
--
ALTER TABLE `loginInfo`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`username`,`ticker`),
  ADD KEY `ticker` (`ticker`);

--
-- Indexes for table `search_history`
--
ALTER TABLE `search_history`
  ADD PRIMARY KEY (`searchID`),
  ADD UNIQUE KEY `searchID` (`searchID`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`ticker`);

--
-- Indexes for table `userHasSearch`
--
ALTER TABLE `userHasSearch`
  ADD PRIMARY KEY (`username`,`searchID`),
  ADD UNIQUE KEY `searchID` (`searchID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `search_history`
--
ALTER TABLE `search_history`
  MODIFY `searchID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `userHasSearch`
--
ALTER TABLE `userHasSearch`
  MODIFY `searchID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD CONSTRAINT `portfolio_ibfk_1` FOREIGN KEY (`username`) REFERENCES `loginInfo` (`username`),
  ADD CONSTRAINT `portfolio_ibfk_2` FOREIGN KEY (`ticker`) REFERENCES `stocks` (`ticker`);

--
-- Constraints for table `userHasSearch`
--
ALTER TABLE `userHasSearch`
  ADD CONSTRAINT `userhassearch_ibfk_1` FOREIGN KEY (`username`) REFERENCES `loginInfo` (`username`),
  ADD CONSTRAINT `userhassearch_ibfk_2` FOREIGN KEY (`searchID`) REFERENCES `search_history` (`searchID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
