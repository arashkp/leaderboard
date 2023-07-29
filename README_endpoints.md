## Endpoints Documentation

### GET `/api/users`

- Description: Fetches the list of users from the database.
- Response: An array of user objects containing the following properties:
    - `id` (integer): User ID.
    - `name` (string): User's name.
    - `age` (integer): User's age.
    - `points` (integer): User's points.
    - `address` (string): User's address.

### POST `/api/user`
Authorization: Requires Inertia authentication.
- Description: Creates a new user in the database.
- Request Body: JSON object with the following properties:
    - `name` (string): User's name (required).
    - `age` (integer): User's age (required).
    - `points` (integer): User's points (default: 0).
    - `address` (string): User's address (required).
- Response: The newly created user object.

### PUT `/api/update`
Authorization: Requires Inertia authentication.
- Description: Creates a new user in the database.
- Request Body: JSON object with the following properties:
    - `userId` (integer): User's Id (required).
    - `points` (integer): User's points (required).
- Response: The newly created user object.

### DELETE `/api/users/{id}`
Authorization: Requires Inertia authentication.
- Description: Deletes the user with the given ID from the database.
- URL Parameter: `id` (integer) - The ID of the user to delete.
- Response: Success on successful deletion.
