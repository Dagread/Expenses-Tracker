import json

class Value:
    def __init__(self, dollar: float, dollarToTimeRate: float):
        self.dollar = dollar
        self.time = dollar/dollarToTimeRate

class Expense:
    def __init__(self, name: str, value: float):
        self.name = name
        self.value = Value(value, 18)
    
    def __str__(self):
        return f"{self.name} ({self.value.dollar} CAD)"

def newEntry():
    name = input("Name of the Expense: ")
    value = float(input("Value of the Expense in CAD: "))
    print(f"Recorded an expense of {value}CAD called {name}")
    return Expense(name, value)

def writeTo(expenses, destination: str):
    json_data = json.dumps(expenses, indent=4)
    with open(destination, "w") as json_file:
        json_file.write(json_data)
    print(f"Saved data to {destination}")
        
def loadFrom(destination):
    with open(destination, "r") as json_file:
        print(f"Loaded data from {destination}")
        return json.load(json_file)

def mainLoop():
    expenses = []
    while True:
        print("Actions:")
        print("\033[91m 0: (x) exit \033[0m")
        print("\033[92m 1: (n) new \033[0m")
        print("\033[94m 2: (v) view \033[0m")
        print("\033[93m 3: (z) undo \033[0m")
        print("\033[96m 4: (s) save \033[0m")
        print("\033[95m 5: (l) load \033[0m")
        action = input("Enter Action: ")
        if(action == "exit" or action == "0" or action == "x"):
            print("bye!")
            return(1)
        elif(action == "new" or action == "1" or action == "n"):
            expenses.append(newEntry())
        elif(action == "view" or action == "2" or action == "v"):
            for exp in expenses:
                print(str(exp))
        elif(action == "undo" or action == "3" or action == "z"):
            element = expenses.pop()
            print(f"Removed {element.name} ({element.value.dollar} CAD) from the list")
        elif(action == "save" or action == "4" or action == "s"):
            destination = input("Save location: ")
            writeTo(expenses, destination)
        elif(action == "load" or action == "5" or action == "l"):
            destination = input("File location: ")
            expenses = loadFrom(destination)
        else:
            print("Unkown command")
        print()
        print()
        print()

if __name__ == "__main__":
    mainLoop()