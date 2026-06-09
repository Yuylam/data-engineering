class SimpleCalc{
    private:
        int x, y;
    public:
        SimpleCalc(int X = 0, int Y = 0);
        
        void setX(int X);
        void setY(int Y);
        int getX();
        int getY();

        int addition() const;
        int subtraction() const;
        int multiplication() const;
        double division() const;
};