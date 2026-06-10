#include <iostream>
using namespace std;

const int SIZE = 50;

// Maze size
// N = ROWS, M = COLS
const int N = 5, M = 5;

class Node{
    public:
    int i, j, d;
    Node* next;

    // Each row has coordinates x, y and the direction
    // 0 = up
    // 1 = right
    // 2 = down
    // 3 = left

    Node(int a = 0, int b = 0, int c = 0, Node* nxt = nullptr){
        i = a;
        j = b;
        d = c;
        next = nxt;
    }
};

class Stack{
    private:
        Node* head;

    public:
        void createStack(){
            head = nullptr;
        }
        void push(int i, int j, int d){
            Node* newNode = new Node(i, j, d, head);
            head = newNode;
        }
        void pop(){
            if(isEmpty()){
                cout << "Cannot pop item. Stack is empty!\n";
            }
            else{
                Node* toDelete = head;
                head = head->next;
                delete toDelete;
            }
        }
        Node* stackTop(){
            if (isEmpty()){
                // cout << "Stack is empty!\n";
                return nullptr;
            }
            else{
                return head;
            }
        }
        void display(){
            char solution[N][M] = {
                {' ', ' ', ' ', ' ', ' '},
                {' ', ' ', ' ', ' ', ' '},
                {' ', ' ', ' ', ' ', ' '},
                {' ', ' ', ' ', ' ', ' '},
                {' ', ' ', ' ', ' ', ' '}};

            Node* current = head;

            while(current){
                int i = current->i;
                int j = current->j;
                int d = current->d;

                cout << "(" << i << ", " << j << ")";
                if(current->next){
                    cout << " -> ";
                }

                if(d == 0) solution[i][j] = '^';
                else if(d == 1) solution[i][j] = '>';
                else if(d == 2) solution[i][j] = 'v';
                else if(d == 3) solution[i][j] = '<';

                current = current->next;
            }
            cout << endl << endl;

            for (int i = 0; i < N; i++){
                cout << "|";
                for (int j = 0; j < M; j++){
                    cout << solution[i][j] << "|";
                }
                cout << endl;
            }
            cout << endl;
        }
        bool isEmpty(){
            return (head == nullptr);
        }
};

// Print Maze Function
void printMaze(int maze[N][M]){
    cout << "<<<<< Current Maze >>>>>\n";
    for (int i = 0; i < N; i++){
        cout << "|";
        for (int j = 0; j < M; j++){
            cout << maze[i][j] << "|";
        }
        cout << endl;
    }
    cout << endl;
}

// Customise Maze
void customiseMaze(int maze[N][M], int* starti, int* startj, int* endi, int* endj){
    cout 
    << "This is a " << M << " * " << N << " maze.\n"
    << "Use 1 to indicate a valid path and 0 for an invalid path\n"
    << "Enter a value followed by a space\n\n";
    
    for (int i = 0; i < N; i++){
        cout << "Row #" << i << ": ";
        for (int j = 0; j < M; j++){
            cin >> maze[i][j];
        }
    }

    printMaze(maze);

    cout
    << "Indicate the starting point and ending point.\n"
    << "Top left coordinate: (0, 0)\n"
    << "Top right coordinate: (" << 0 << ", " << M-1 << ")\n\n";

    cout << "Starting coordinate-i: ";
    cin >> *starti;
    while(*starti >= N || *starti < 0){
        cout << "Invalid value\n";
        cout << "Starting coordinate-i: ";
        cin >> *starti;
    }
    cout << "Starting coordinate-j: ";
    cin >> *startj;
    while(*startj >= M || *startj < 0){
        cout << "Invalid value\n";
        cout << "Starting coordinate-j: ";
        cin >> *startj;
    }
    cout << "Exit coordinate-i: ";
    cin >> *endi;
    while(*endi >= N || *endi < 0){
        cout << "Invalid value\n";
        cout << "Exit coordinate-i: ";
        cin >> *endi;
    }
    cout << "Exit coordinate-j: ";
    cin >> *endj;
    while(*endj >= M || *endi < 0){
        cout << "Invalid value\n";
        cout << "Exit coordinate-y: ";
        cin >> *endj;
    }

    cout << endl;
}

// Solve Maze
bool solveMaze(Stack* path, int maze[N][M], int endi = N-1, int endj = M-1){
    bool visited[N][M] = {0};
    visited[0][0] = true;
    bool pathFound = false;

    while(!path->isEmpty()){
        Node* temp = path->stackTop();
        int i = temp->i;
        int j = temp->j;
        int d = temp->d;

        // If we reach the end
        if (i == endi && j == endj){
            cout << "Path Found\n";
            path->display();
            return true;
        }

        // Checking each direction
        if(d == 0){         // Up
            if(i - 1 >= 0 && maze[i - 1][j] && !visited[i - 1][j]){
                visited[i - 1][j] = true;
                path->push(i - 1, j, 0);
            }
            else{
                path->pop();
                path->push(i, j, 1);
            }
        }
        else if(d == 1){    // Right
            if(j + 1 < M && maze[i][j + 1] && !visited[i][j + 1]){
                visited[i][j + 1] = true;
                path->push(i, j + 1, 0);
            }
            else{
                path->pop();
                path->push(i, j, 2);
            }
        }
        else if(d == 2){    // Down
            if(i + 1 < N && maze[i + 1][j] && !visited[i + 1][j]){
                visited[i + 1][j] = true;
                path->push(i + 1, j, 0);
            }
            else{
                path->pop();
                path->push(i, j, 3);
            }
        }
        else if(d == 3){    // Left
            if(j - 1 >= 0 && maze [i][j - 1] && !visited[i][j - 1]){
                visited[i][j - 1] = true;
                path->push(i, j - 1, 0);
            }
            else{
                path->pop();
                path->push(i, j, 4);
            }
        }
        else{
            visited[i][j] = true;
            path->pop();
        }
    }

    cout << "Path Not Found\n\n";
    return false;
}

int main(){
    // Program Introduction
    cout 
    << "*************** Maze Solving Program ***************\n"
    << "The maze is solved using backtracking algorithm.\n"
    << "The algorithm is implemented using pointer-based stack.\n"
    << "Stack operations are implemented in solveMaze().\n\n";

    int defaultMaze[N][M] = {
        {1, 1, 1, 1, 0},
        {1, 0, 0, 1, 0},
        {1, 1, 0, 1, 0},
        {1, 0, 0, 1, 0},
        {1, 1, 1, 1, 1}};
    
    int customMaze[N][M] = {
        {0, 0, 0, 0, 0},
        {0, 0, 0, 0, 0},
        {0, 0, 0, 0, 0},
        {0, 0, 0, 0, 0},
        {0, 0, 0, 0, 0}};

    int maze[N][M];
    for (int i = 0; i < N; i++) {
        for (int j = 0; j < M; j++) {
            maze[i][j] = defaultMaze[i][j];
        }
    }

    // Start and End coordinates
    int starti = 0;
    int startj = 0;
    int endi = N-1;
    int endj = M-1;

    int choice = 1;

    while (choice != 5){
        cout 
        << "<<<<< Menu >>>>>\n"
        << "1. Print maze\n"
        << "2. Use Customise maze\n"
        << "3. Use Default maze\n"
        << "4. Solve maze\n"
        << "5. Quit\n"
        << "Choice: ";
        cin >> choice;

        cout << endl;

        if(choice == 1){
            printMaze(maze);
        }
        else if(choice == 2){
            cout << "<<<<< Customise Maze >>>>>\n";
            customiseMaze(customMaze, &starti, &startj, &endi, &endj);
            for (int i = 0; i < N; i++) {
                for (int j = 0; j < M; j++) {
                    maze[i][j] = customMaze[i][j];
                }
            }
        }
        else if(choice == 3){

            for (int i = 0; i < N; i++) {
                for (int j = 0; j < M; j++) {
                    maze[i][j] = defaultMaze[i][j];
                }
            }
            starti = 0;
            startj = 0;
            endi = N-1;
            endj = M-1;
        }
        else if(choice == 4){
            // Create and push starting cell onto the stack
            Stack path;
            path.createStack();
            path.push(starti, startj, 0);

            // Solve maze
            cout << "Solving Maze...\n";
            bool pathFound = solveMaze(&path, maze, endi, endj);
        }
        else if(choice == 5){
            cout << "Terminating...\n";
            return 0;
        }
    }
}