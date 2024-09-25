

CREATE TABLE `tbl_account_class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `type_code` int(11) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_account_class` VALUES('1','Cash on Hand','This is Cash on Hand','6');
INSERT INTO `tbl_account_class` VALUES('2','Cash in Bank','This is Cash in Bank','6');
INSERT INTO `tbl_account_class` VALUES('3','Loans and Receivable Accounts','This is Loans and Receivable Accounts','6');
INSERT INTO `tbl_account_class` VALUES('4','Due from Officers and Employees','This is Due','6');
INSERT INTO `tbl_account_class` VALUES('5','Inter-Agency Receivables','This is Inter-Agency Receivables','6');
INSERT INTO `tbl_account_class` VALUES('6','Advances','This is Advances ','6');
INSERT INTO `tbl_account_class` VALUES('7','Other Receivables','This is other receivables','6');
INSERT INTO `tbl_account_class` VALUES('8','Inventory Held for Consumption','This is Inventory','6');
INSERT INTO `tbl_account_class` VALUES('9','Inventory Held for Distribution','This is Inventory Held for Distribution','6');
INSERT INTO `tbl_account_class` VALUES('10','Prepayments','This is Prepayments','6');
INSERT INTO `tbl_account_class` VALUES('11','Property, Plant and Equipment','PPE','7');
INSERT INTO `tbl_account_class` VALUES('12','Buildings & other structures','Buildings','7');
INSERT INTO `tbl_account_class` VALUES('13','Machinery and Equipment','Machines','7');
INSERT INTO `tbl_account_class` VALUES('14','Furnitures, Fixture & Books','For Furnitures','7');
INSERT INTO `tbl_account_class` VALUES('15','Transportation Equipment','This is for Transportation','7');
INSERT INTO `tbl_account_class` VALUES('16','Other Property, Plant & Equipment','Other PPE','7');
INSERT INTO `tbl_account_class` VALUES('17','Current Liabilities','Current liabilities (also called short-term liabilities) are debts a company must pay within a normal operating cycle, usually less than 12 months','2');
INSERT INTO `tbl_account_class` VALUES('18','Inter-agency Payables','This account is used to recognize withholding of taxes from officers/employees and other entities. Debit this account for remittance of the taxes withheld to the BIR.','2');
INSERT INTO `tbl_account_class` VALUES('19','Trust Liabilities','This account is used to recognize the receipt of amount held in trust for specific purpose. Debit this account for payment or settlement of the liability.','2');
INSERT INTO `tbl_account_class` VALUES('20','Payables','Obligations/ commitments of national government agencies, whether current year and prior years, for which services have been rendered, goods have been delivered or projects have been completed and accepted.','2');
INSERT INTO `tbl_account_class` VALUES('21','Salaries and Wages','Expenses Due to Salaries and Wages','10');
INSERT INTO `tbl_account_class` VALUES('22','Other Compensation','This is for other compensation to employees and workers','10');
INSERT INTO `tbl_account_class` VALUES('23','Personnel Benefit Contributions','These are the benefits being received by employees','10');
INSERT INTO `tbl_account_class` VALUES('24','Other Personnel Benefits','These accounts are other personnel benefits','10');
INSERT INTO `tbl_account_class` VALUES('25','Traveling Expense','This for traveling expenses for local destinations','11');
INSERT INTO `tbl_account_class` VALUES('26','Training and Scholarship Expense','This is for Training and Scholarship Expense','11');
INSERT INTO `tbl_account_class` VALUES('27','Supplies and Materials Expense','This is for Supplies and Materials','11');
INSERT INTO `tbl_account_class` VALUES('28','Utility Expense','This is for water and electric bills','11');
INSERT INTO `tbl_account_class` VALUES('29','Communication Expenses','For Communication Expenses','11');
INSERT INTO `tbl_account_class` VALUES('30','Generation, Transmission and Distribution Expense','This is for Generation, Transmission and Distribution Expense','11');
INSERT INTO `tbl_account_class` VALUES('31','Confidential, Intelligence and Extraordinary Expenses','This is for Confidential, Intelligence and Extraordinary Expenses','11');
INSERT INTO `tbl_account_class` VALUES('32','Professional Services','This for Professional Service rendered','11');
INSERT INTO `tbl_account_class` VALUES('33','Repairs and Maintenance','This is for Repairs and Maintenance','11');
INSERT INTO `tbl_account_class` VALUES('34','Taxes, Insurance Premiums and Other Fees','This is Taxes','11');
INSERT INTO `tbl_account_class` VALUES('35','Other Maintenance and Operating Expenses','This is Other Maintenance','11');
INSERT INTO `tbl_account_class` VALUES('36','Equity','Equity','3');
INSERT INTO `tbl_account_class` VALUES('37','Depreciation','is the accounting process of allocating the cost of a tangible asset over its useful life.','12');
INSERT INTO `tbl_account_class` VALUES('38','Impairment Loss','This is for impairment loss','12');



CREATE TABLE `tbl_account_title` (
  `account_code` int(8) NOT NULL,
  `account_name` varchar(150) NOT NULL,
  `account_type` varchar(150) NOT NULL,
  `type_code` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `class_id` int(10) NOT NULL,
  PRIMARY KEY (`account_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_account_title` VALUES('10101010','Cash-Collecting Officers','Current Assets','6','2','1');
INSERT INTO `tbl_account_title` VALUES('10101020','Petty Cash - General Fund','Current Assets','6','2','1');
INSERT INTO `tbl_account_title` VALUES('10101030','Local Currency on Hand','Current Assets','6','1','0');
INSERT INTO `tbl_account_title` VALUES('10101060','Bao ','Contra-Asset','8','0','0');
INSERT INTO `tbl_account_title` VALUES('10102020','Cash in Bank, Local Currency - Current Accounts','Current Assets','6','1','2');
INSERT INTO `tbl_account_title` VALUES('10102030','Cash in Bank-Local Currency, Savings Account','Current Assets','6','1','2');
INSERT INTO `tbl_account_title` VALUES('10301010','Accounts Receivable','Current Assets','6','1','3');
INSERT INTO `tbl_account_title` VALUES('10301012','Allowance for Impairment- Accounts Receivable','Contra-Asset','8','4','3');
INSERT INTO `tbl_account_title` VALUES('10301020','Notes Receivable','Current Assets','6','0','0');
INSERT INTO `tbl_account_title` VALUES('10303010','Due from NGAs','Current Assets','6','2','5');
INSERT INTO `tbl_account_title` VALUES('10303050','Due from Government Corporation','Current Assets','6','2','5');
INSERT INTO `tbl_account_title` VALUES('10399010','Receivables-Disallowances/Charges','Current Assets','6','2','7');
INSERT INTO `tbl_account_title` VALUES('10399020','Due from Officers and Employees','Current Assets','6','2','4');
INSERT INTO `tbl_account_title` VALUES('10399022','Allowance for Impairment-Due from Officers and Employees','Contra-Asset','8','4','4');
INSERT INTO `tbl_account_title` VALUES('10399990','Other Receivables','Current Assets','6','1','7');
INSERT INTO `tbl_account_title` VALUES('10404020','Accountable Forms, Plates and Stickers Inventory','Current Assets','6','5','8');
INSERT INTO `tbl_account_title` VALUES('10404120','Chemical and Filtering Supplies Inventory','Current Assets','6','5','9');
INSERT INTO `tbl_account_title` VALUES('10404130','Construction Materials Inventory','Current Assets','6','5','9');
INSERT INTO `tbl_account_title` VALUES('10404990','Other Supplies and Materials Inventory','Current Assets','6','5','9');
INSERT INTO `tbl_account_title` VALUES('10601010','Land','Non-Current Assets','7','5','11');
INSERT INTO `tbl_account_title` VALUES('10603040','Water Supply Systems','Non-Current Assets','7','5','16');
INSERT INTO `tbl_account_title` VALUES('10603041','Accumulated Depreciation-Water Supply System','Contra-Asset','8','4','16');
INSERT INTO `tbl_account_title` VALUES('10604010','Buildings','Non-Current Assets','7','5','12');
INSERT INTO `tbl_account_title` VALUES('10604011','Accumulated Depreciation- Building','Contra-Asset','8','4','12');
INSERT INTO `tbl_account_title` VALUES('10604990','Other Structures','Non-Current Assets','7','5','12');
INSERT INTO `tbl_account_title` VALUES('10604991','Accumulated Depreciation-Other Structures','Contra-Asset','8','4','12');
INSERT INTO `tbl_account_title` VALUES('10605020','Office Equipment','Non-Current Assets','7','5','0');
INSERT INTO `tbl_account_title` VALUES('10605021','Accumulated Depreciation-Office Equipment','Non-Current Assets','7','4','0');
INSERT INTO `tbl_account_title` VALUES('10605030','ICT Equipment','Non-Current Assets','7','5','13');
INSERT INTO `tbl_account_title` VALUES('10605031','Accumulated Depreciation-ICT Equipment','Contra-Asset','8','4','13');
INSERT INTO `tbl_account_title` VALUES('10605070','Communications Equipment','Non-Current Assets','7','0','0');
INSERT INTO `tbl_account_title` VALUES('10605071','Accumulated Depreciation-Communications Equipment','Non-Current Assets','7','4','0');
INSERT INTO `tbl_account_title` VALUES('10605990','Other Machineries and Equipment','Non-Current Assets','7','6','13');
INSERT INTO `tbl_account_title` VALUES('10605991','Accumulated Depreciation-Other Machinery and Equipment','Contra-Asset','8','4','13');
INSERT INTO `tbl_account_title` VALUES('10606010','Motor Vehicles','Non-Current Assets','7','6','15');
INSERT INTO `tbl_account_title` VALUES('10606011','Accumulated Depreciation-Motor Vehicles','Contra-Asset','8','4','15');
INSERT INTO `tbl_account_title` VALUES('10606990','Other Transportation Equipment','Non-Current Assets','7','6','15');
INSERT INTO `tbl_account_title` VALUES('10606991','Accumulated Depreciation-Other Transportation Equipment','Contra-Asset','8','4','15');
INSERT INTO `tbl_account_title` VALUES('10607010','Furnitures and Fixtures','Non-Current Assets','7','6','14');
INSERT INTO `tbl_account_title` VALUES('10607011','Accumulated Depreciation- Furnitures and Fixtures','Contra-Asset','8','0','14');
INSERT INTO `tbl_account_title` VALUES('10698020','Construction in Progress-Infrastructure Assets','Non-Current Assets','7','0','0');
INSERT INTO `tbl_account_title` VALUES('19901020','Advances for Payroll','Current Assets','6','6','6');
INSERT INTO `tbl_account_title` VALUES('19901040','Advances to Officers and Employees','Current Assets','6','4','6');
INSERT INTO `tbl_account_title` VALUES('19902020','Prepaid Rent','Current Assets','6','3','10');
INSERT INTO `tbl_account_title` VALUES('19902990','Other Prepayments','Current Assets','6','3','10');
INSERT INTO `tbl_account_title` VALUES('19999990','Other Assets','Current Assets','6','5','0');
INSERT INTO `tbl_account_title` VALUES('20101010','Accounts Payable','Liabilities','2','0','20');
INSERT INTO `tbl_account_title` VALUES('20101020','Due to Officers and Employees','Liabilities','2','4','17');
INSERT INTO `tbl_account_title` VALUES('20101040','Loans Payable-Domestic','Liabilities','2','3','17');
INSERT INTO `tbl_account_title` VALUES('20101050','Interest Payable','Liabilities','2','3','17');
INSERT INTO `tbl_account_title` VALUES('20102041','Loans Payable-Domestic (Current)','Long-Term Liabilities','9','3','0');
INSERT INTO `tbl_account_title` VALUES('20201010','Due to BIR','Liabilities','2','4','18');
INSERT INTO `tbl_account_title` VALUES('20201020','Due to GSIS','Liabilities','2','4','18');
INSERT INTO `tbl_account_title` VALUES('20201030','Due to Pag-IBIG','Liabilities','2','4','18');
INSERT INTO `tbl_account_title` VALUES('20201040','Due to PhilHealth','Liabilities','2','4','18');
INSERT INTO `tbl_account_title` VALUES('20201050','Due to NGAs','Liabilities','2','4','18');
INSERT INTO `tbl_account_title` VALUES('20401040','Guaranty/Security Deposit Payable','Liabilities','2','3','19');
INSERT INTO `tbl_account_title` VALUES('20401050','Customers\' Deposits Payable','Liabilities','2','3','19');
INSERT INTO `tbl_account_title` VALUES('20501990','Other Deferred Credits','Long-Term Liabilities','9','0','0');
INSERT INTO `tbl_account_title` VALUES('30101020','Government Equity','Equity','3','0','0');
INSERT INTO `tbl_account_title` VALUES('30701010','Retained Earnings','Equity','3','0','0');
INSERT INTO `tbl_account_title` VALUES('30801010','Share Capital','Equity','3','0','0');
INSERT INTO `tbl_account_title` VALUES('40202090','Waterworks System Fee','Income','5','0','0');
INSERT INTO `tbl_account_title` VALUES('40202210','Income Interest','Income','5','0','0');
INSERT INTO `tbl_account_title` VALUES('40202230','Fines and Penalties-Business Income','Income','5','0','0');
INSERT INTO `tbl_account_title` VALUES('40202990','Other Business Income','Income','5','0','0');
INSERT INTO `tbl_account_title` VALUES('40403010','Grants in Cash','Income','5','0','0');
INSERT INTO `tbl_account_title` VALUES('40699990','Miscellaneous Income','Income','5','0','0');
INSERT INTO `tbl_account_title` VALUES('50101010','Salaries and Wages - Regular','Personnel Services','10','3','21');
INSERT INTO `tbl_account_title` VALUES('50101020','Salaries and Wages - Casual/Contractual','Personnel Services','10','3','21');
INSERT INTO `tbl_account_title` VALUES('50102010','Personal Economic Relief Allowance (PERA)','Personnel Services','10','3','22');
INSERT INTO `tbl_account_title` VALUES('50102020','Representation Allowance(RA)','Personnel Services','10','3','22');
INSERT INTO `tbl_account_title` VALUES('50102030','Transportation Allowance(TA)','Personnel Services','10','3','22');
INSERT INTO `tbl_account_title` VALUES('50102040','Clothing/Uniform Allowance','Personnel Services','10','3','22');
INSERT INTO `tbl_account_title` VALUES('50102100','Honoraria','Personnel Services','10','3','22');
INSERT INTO `tbl_account_title` VALUES('50102130','Overtime and Night Pay','Personnel Services','10','3','22');
INSERT INTO `tbl_account_title` VALUES('50102150','Cash Gift','Expenses','4','0','0');
INSERT INTO `tbl_account_title` VALUES('50103010','Retirement and Life Insurance Premium','Personnel Services','10','3','23');
INSERT INTO `tbl_account_title` VALUES('50103020','Pag-IBIG Contributions','Personnel Services','10','3','23');
INSERT INTO `tbl_account_title` VALUES('50103030','PhilHealth Contributions','Personnel Services','10','3','23');
INSERT INTO `tbl_account_title` VALUES('50103040','Employees Compensation Insurance Premiums','Personnel Services','10','3','23');
INSERT INTO `tbl_account_title` VALUES('50104990','Other Personnel Benefits','Personnel Services','10','3','24');
INSERT INTO `tbl_account_title` VALUES('50201010','Traveling Expenses - Local','Maintenance and Other Operating Expenses','11','0','25');
INSERT INTO `tbl_account_title` VALUES('50202010','Training Expenses','Maintenance and Other Operating Expenses','11','0','26');
INSERT INTO `tbl_account_title` VALUES('50203010','Office Supplies Expenses','Maintenance and Other Operating Expenses','11','5','27');
INSERT INTO `tbl_account_title` VALUES('50203020','Accountable Form Expenses','Expenses','4','5','27');
INSERT INTO `tbl_account_title` VALUES('50203090','Fuel, Oil and Lubricants Expenses','Maintenance and Other Operating Expenses','11','5','27');
INSERT INTO `tbl_account_title` VALUES('50203130','Chemicals and Filtering Supplies Expenses','Expenses','4','0','0');
INSERT INTO `tbl_account_title` VALUES('50203210','Semi Expendable Machinery and Equipment Expenses','Maintenance and Other Operating Expenses','11','5','27');
INSERT INTO `tbl_account_title` VALUES('50204020','Electricity Expenses','Maintenance and Other Operating Expenses','11','3','28');
INSERT INTO `tbl_account_title` VALUES('50205010','Postage and Courier Services','Maintenance and Other Operating Expenses','11','3','29');
INSERT INTO `tbl_account_title` VALUES('50205020','Telephone Expenses','Maintenance and Other Operating Expenses','11','3','29');
INSERT INTO `tbl_account_title` VALUES('50209010','Generation, Transmission and Distribution Expenses','Maintenance and Other Operating Expenses','11','3','30');
INSERT INTO `tbl_account_title` VALUES('50210030','Extraordinary and Miscellaneous Expense','Maintenance and Other Operating Expenses','11','0','31');
INSERT INTO `tbl_account_title` VALUES('50211010','Legal Services','Maintenance and Other Operating Expenses','11','0','32');
INSERT INTO `tbl_account_title` VALUES('50211020','Auditing Services','Maintenance and Other Operating Expenses','11','0','32');
INSERT INTO `tbl_account_title` VALUES('50211990','Other Professional Services','Maintenance and Other Operating Expenses','11','0','32');
INSERT INTO `tbl_account_title` VALUES('50212990','Other General Services','Expenses','4','0','0');
INSERT INTO `tbl_account_title` VALUES('50213030','Repair and Maintenance - Infrastructure Assets','Maintenance and Other Operating Expenses','11','0','33');
INSERT INTO `tbl_account_title` VALUES('50213040','Repair and Maintenance - Building and Other Structures','Maintenance and Other Operating Expenses','11','0','33');
INSERT INTO `tbl_account_title` VALUES('50213050','Repair and Maintenance - Machinery and Equipment','Maintenance and Other Operating Expenses','11','0','33');
INSERT INTO `tbl_account_title` VALUES('50213060','Repair and Maintenance - Transportation Equipment','Maintenance and Other Operating Expenses','11','0','33');
INSERT INTO `tbl_account_title` VALUES('50213070','Repair and Maintenance - Furniture and Fixtures','Maintenance and Other Operating Expenses','11','0','33');
INSERT INTO `tbl_account_title` VALUES('50215010','Taxes, Duties and Licenses','Maintenance and Other Operating Expenses','11','0','34');
INSERT INTO `tbl_account_title` VALUES('50215020','Fidelity Bond Premium','Maintenance and Other Operating Expenses','11','0','34');
INSERT INTO `tbl_account_title` VALUES('50215030','Insurance/Reinsurance Expense','Maintenance and Other Operating Expenses','11','0','34');
INSERT INTO `tbl_account_title` VALUES('50216010','Labor and Wages - Contractual','Expenses','4','0','0');
INSERT INTO `tbl_account_title` VALUES('50299010','Advertising, Promotional and Marketing Expenses','Maintenance and Other Operating Expenses','11','3','35');
INSERT INTO `tbl_account_title` VALUES('50299020','Printing and Publication Expenses','Maintenance and Other Operating Expenses','11','3','35');
INSERT INTO `tbl_account_title` VALUES('50299030','Representation Expenses','Maintenance and Other Operating Expenses','11','3','35');
INSERT INTO `tbl_account_title` VALUES('50299050','Rent/Lease Expenses','Maintenance and Other Operating Expenses','11','3','35');
INSERT INTO `tbl_account_title` VALUES('50299060','Membership Dues and Contribution to Organization','Maintenance and Other Operating Expenses','11','0','35');
INSERT INTO `tbl_account_title` VALUES('50301010','Internet Expense','Financial Expense','13','3','0');
INSERT INTO `tbl_account_title` VALUES('50301040','Bank Charges','Financial Expense','13','3','0');
INSERT INTO `tbl_account_title` VALUES('50501060','Depreciation - Transportation Equipment','Non Cash Expense','12','4','37');
INSERT INTO `tbl_account_title` VALUES('50501070','Depreciation - Furniture, Fixtures and Books','Non Cash Expense','12','4','37');
INSERT INTO `tbl_account_title` VALUES('50501990','Depreciation - Other Property, Plant Equipment','Expenses','4','4','37');
INSERT INTO `tbl_account_title` VALUES('50503020','Impairment Loss - Loans and Receivables','Non Cash Expense','12','0','38');



CREATE TABLE `tbl_account_type` (
  `type_code` int(8) NOT NULL AUTO_INCREMENT,
  `account_type` varchar(100) NOT NULL,
  `normal_balance` varchar(100) NOT NULL,
  `type_description` text NOT NULL,
  `main_type_id` int(10) NOT NULL,
  PRIMARY KEY (`type_code`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_account_type` VALUES('2','Liabilities','Credit','It is used to keep track of all legally-binding debts that must be paid to someone else','2');
INSERT INTO `tbl_account_type` VALUES('3','Equity','Credit','Equity accounts represent the financial ownership in a company and are visible in the balance sheet immediately after the liability accounts.','3');
INSERT INTO `tbl_account_type` VALUES('4','Expenses','Debit','','4');
INSERT INTO `tbl_account_type` VALUES('5','Income','Credit','','5');
INSERT INTO `tbl_account_type` VALUES('6','Current Assets','Debit','It is any resource a company could use, turn into cash, or sell within a year.','1');
INSERT INTO `tbl_account_type` VALUES('7','Non-Current Assets','Debit','They are assets and property owned by a business that are not easily converted to cash within a year','1');
INSERT INTO `tbl_account_type` VALUES('8','Contra-Asset','Credit',' The account offsets the balance in the respective asset account that it is paired with on the balance sheet.','1');
INSERT INTO `tbl_account_type` VALUES('9','Long-Term Liabilities','Credit','Long-term liabilities, also called long-term debts, are debts a company owes third-party creditors that are payable beyond 12 months.','2');
INSERT INTO `tbl_account_type` VALUES('10','Personnel Services','Debit',' This is for Personnel Services Expenses','5');
INSERT INTO `tbl_account_type` VALUES('11','Maintenance and Other Operating Expenses','Debit',' For Maintenance Expenses','5');
INSERT INTO `tbl_account_type` VALUES('12','Non Cash Expense','Debit',' Non Cash Expenses','5');
INSERT INTO `tbl_account_type` VALUES('13','Financial Expense','Debit','They are costs incurred from borrowing from lenders or creditors.','5');



CREATE TABLE `tbl_fiscal_year` (
  `fiscal_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text NOT NULL,
  `fiscal_status` varchar(100) NOT NULL,
  PRIMARY KEY (`fiscal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_fiscal_year` VALUES('1','2024-01-01','2024-12-31','F.Y-2024','Active');
INSERT INTO `tbl_fiscal_year` VALUES('2','2025-01-01','2025-12-31','F.Y-2025','Inactive');
INSERT INTO `tbl_fiscal_year` VALUES('3','2026-01-01','2026-12-31','F.Y-2026','Inactive');
INSERT INTO `tbl_fiscal_year` VALUES('4','2027-01-01','2027-12-31','F.Y-2027','Inactive');



CREATE TABLE `tbl_general_ledger` (
  `ledger_id` int(8) NOT NULL AUTO_INCREMENT,
  `ledger_date` date NOT NULL,
  `account_code` int(8) NOT NULL,
  `debit` decimal(10,2) NOT NULL,
  `credit` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `journal_voucher_id` int(8) NOT NULL,
  `fiscal_id` int(10) NOT NULL,
  PRIMARY KEY (`ledger_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_general_ledger` VALUES('1','2024-06-12','10101010','2000.00','0.00','To record Cash Collecting','1','1');
INSERT INTO `tbl_general_ledger` VALUES('2','2024-06-12','10301020','0.00','2000.00','To Record Cash Collecting','1','1');
INSERT INTO `tbl_general_ledger` VALUES('26','2024-09-09','10605030','1500.00','0.00','To record ICT Equipment','33','1');
INSERT INTO `tbl_general_ledger` VALUES('27','2024-09-09','10101010','0.00','1500.00','To record ICT Equipment','33','1');
INSERT INTO `tbl_general_ledger` VALUES('28','2024-09-11','10101010','500.00','0.00','To record ICT Equipment','34','1');
INSERT INTO `tbl_general_ledger` VALUES('29','2024-09-11','10101020','0.00','500.00','To record ICT Equipment','34','1');



CREATE TABLE `tbl_help` (
  `help_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` varchar(100) NOT NULL,
  `context` text NOT NULL,
  PRIMARY KEY (`help_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_help` VALUES('1','Login','Logging in on your device requires a username and password');
INSERT INTO `tbl_help` VALUES('2','Navigation','This page will show the navigation of the entire web application\r\n');
INSERT INTO `tbl_help` VALUES('3','Journal Management','This will show how to manage the journal entries of the system');



CREATE TABLE `tbl_help_items` (
  `help_item_id` int(10) NOT NULL AUTO_INCREMENT,
  `help_id` int(10) NOT NULL,
  `help_text` text NOT NULL,
  `photo_documentation` varchar(150) NOT NULL,
  PRIMARY KEY (`help_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_help_items` VALUES('1','1','1)	The system needs a username and password access the system, you must login with your username and password as stated by the system administrator.','');



CREATE TABLE `tbl_journal_category` (
  `category_id` int(8) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_description` text NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_journal_category` VALUES('0','Miscellaneous ',' ');
INSERT INTO `tbl_journal_category` VALUES('1','Billing','For the Billing Processes');
INSERT INTO `tbl_journal_category` VALUES('2','Collection','This category is for the collection Processes of the Water District');
INSERT INTO `tbl_journal_category` VALUES('3','Disbursement','Records payment transactions of the organization');
INSERT INTO `tbl_journal_category` VALUES('4','Adjustments/Accrual','Used for adjusting entries and accrued transactions');
INSERT INTO `tbl_journal_category` VALUES('5','Materials','Used for materials in the inventory');



CREATE TABLE `tbl_journal_entry` (
  `journal_voucher_id` int(8) NOT NULL AUTO_INCREMENT,
  `journal_voucher_no` varchar(10) NOT NULL,
  `journal_date` date NOT NULL,
  `description` text NOT NULL,
  `uid` int(8) NOT NULL,
  `category_id` int(10) NOT NULL,
  `fiscal_id` int(11) NOT NULL,
  PRIMARY KEY (`journal_voucher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_journal_entry` VALUES('1','24-0001','2024-06-12','To record Collecting Payments','1','1','1');
INSERT INTO `tbl_journal_entry` VALUES('2','24-0002','2024-06-13','To record Petty Cash ','1','3','1');
INSERT INTO `tbl_journal_entry` VALUES('33','24-0003','2024-09-09','To record ICT Equipment','1','1','1');
INSERT INTO `tbl_journal_entry` VALUES('34','24-0004','2024-09-10','To record ICT Equipment','1','2','1');



CREATE TABLE `tbl_journal_items` (
  `journal_item_id` int(8) NOT NULL AUTO_INCREMENT,
  `journal_voucher_id` int(10) NOT NULL,
  `account_code` int(8) NOT NULL,
  `journal_amount` decimal(10,2) NOT NULL,
  `journal_adjustment` varchar(100) NOT NULL,
  PRIMARY KEY (`journal_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_journal_items` VALUES('1','1','10101010','2000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('2','1','10301020','2000.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('3','2','10101010','1500.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('4','2','10101020','1500.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('7','33','10605030','1500.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('8','33','10101010','1500.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('9','34','10101010','500.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('10','34','10101020','500.00','Credit');



CREATE TABLE `tbl_main_account_type` (
  `main_type_id` int(10) NOT NULL,
  `main_type_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `reports_included` varchar(100) NOT NULL,
  PRIMARY KEY (`main_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_main_account_type` VALUES('1','Asset','Something a business has or owns ','Balance Sheet');
INSERT INTO `tbl_main_account_type` VALUES('2','Liabilities','Something we owe to a non-owner','Balance Sheet');
INSERT INTO `tbl_main_account_type` VALUES('3','Equity','Something we owe to the owners or the value of the investment to the owner','Balance Sheet');
INSERT INTO `tbl_main_account_type` VALUES('4','Income','Value of the goods we have sold or the services we have performed','Income Statement');
INSERT INTO `tbl_main_account_type` VALUES('5','Expenses','Costs of doing business\r\n','Income Statement\r\n');



CREATE TABLE `tbl_trial_balance` (
  `trial_balance_id` int(10) NOT NULL AUTO_INCREMENT,
  `account_code` int(8) NOT NULL,
  `total_debit` decimal(10,2) NOT NULL,
  `total_credit` decimal(10,2) NOT NULL,
  `trial_balance_date` date NOT NULL,
  `ledger_id` int(10) NOT NULL,
  `fiscal_id` int(11) NOT NULL,
  PRIMARY KEY (`trial_balance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_trial_balance` VALUES('1','10101020','2000.00','0.00','2024-08-28','15','1');
INSERT INTO `tbl_trial_balance` VALUES('2','30801010','0.00','2000.00','2024-08-28','16','1');
INSERT INTO `tbl_trial_balance` VALUES('14','10605030','1500.00','0.00','2024-09-09','26','1');
INSERT INTO `tbl_trial_balance` VALUES('15','10101010','0.00','1500.00','2024-09-09','27','1');
INSERT INTO `tbl_trial_balance` VALUES('16','10101010','500.00','0.00','2024-09-11','28','1');
INSERT INTO `tbl_trial_balance` VALUES('17','10101020','0.00','500.00','2024-09-11','29','1');



CREATE TABLE `tbl_user` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `userlevel` varchar(100) NOT NULL,
  `user_status` varchar(100) NOT NULL,
  `user_info_id` int(10) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_user` VALUES('1','admin','$2y$10$Sia0EyxKRHkR5xlNDJeyvO.tLcIwSrZHhBYxO6beqy0GGxpGhDXhm','Administrator','Active','1');
INSERT INTO `tbl_user` VALUES('2','user2','$2y$10$8FuuJWc8QMb/p.R79jGgL.G.uAWv2TsuAr9y0X.6Rar8BpVbeiyFq','Cashier','Active','2');



CREATE TABLE `tbl_user_info` (
  `user_info_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_fname` varchar(120) NOT NULL,
  `user_mname` varchar(120) NOT NULL,
  `user_lname` varchar(120) NOT NULL,
  PRIMARY KEY (`user_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_user_info` VALUES('1','Jack','Lopez','Gates');
INSERT INTO `tbl_user_info` VALUES('2','Jenny','Lopes','Reyes');

