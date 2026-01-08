. System Overview and Purpose

The Book Portal System is a simple web-based library management system developed using PHP, MySQL, HTML, CSS, and Bootstrap. The system allows users to borrow books, return books, and view borrowing history in an organized and efficient way.

The main purpose of the system is to:

Track borrowed books

Record return dates

Maintain a complete borrowing history

Provide role-based access for admin and regular users

This system is suitable for small libraries, school projects, or basic inventory tracking applications.

2. Database Tables and Relationships
📘 Table: users

Stores user login and registration information.

Fields:

id – Primary key

name – Full name of the user

username – Unique username

email – Unique email address

password – User password

role – User role (admin or user)

created_at – Date the account was created

Purpose:

Handles authentication (login & registration)

Determines user access level

📕 Table: borrow_records

Stores all book borrowing and returning transactions.

Fields:

id – Primary key

book_id – ID of the book

book_title – Title of the book

borrower_name – Name of the borrower

borrow_date – Date when the book was borrowed

required_return_date – Expected return date

return_date – Actual return date (NULL if not returned)

created_at – Record creation timestamp

Purpose:

Tracks borrowed books

Identifies unreturned books

Displays borrowing and return history

🔗 Table Relationship

The system uses a logical relationship between users and borrow records.

Borrowing actions are associated with users through session login (not foreign keys).

3. Sample Outputs / Query Results
📌 Sample Query: Unreturned Books
SELECT * FROM borrow_records WHERE return_date IS NULL;

Output Example:

Book ID	Book Title	Borrower	Borrow Date	Required Return
B001	Database Systems	Juan Dela Cruz	2026-01-01	2026-01-08
📌 Sample Query: Borrowing History
SELECT * FROM borrow_records;

Output Example:

Book ID	Book Title	Borrower	Borrow Date	Required Return	Return Date
B001	Database Systems	Juan Dela Cruz	2026-01-01	2026-01-08	2026-01-06
B002	Web Programming	Maria Santos	2026-01-02	2026-01-09	Not Returned
📌 Sample Screenshot Description (for documentation)

Borrow Page: Shows a form for borrowing books and a table listing borrowed books

Return Page: Displays unreturned books and allows marking a book as returned

History Page: Displays all borrowing records including returned and unreturned books
