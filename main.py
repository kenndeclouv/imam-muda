import numpy as np
import matplotlib.pyplot as plt

# Fungsi parabola
def parabola1(x):
    return -x**2 + 4

def parabola2(x):
    return -x**2 + 2*x + 3

# Rentang x
x = np.linspace(-3, 4, 400)

# Hitung y
y1 = parabola1(x)
y2 = parabola2(x)

# Plot kedua grafik
plt.plot(x, y1, label=r'$y = -x^2 + 4$', color='blue')
plt.plot(x, y2, label=r'$y = -x^2 + 2x + 3$', color='red')

# Arsiran daerah yang memenuhi kedua ketidaksetaraan
plt.fill_between(x, np.minimum(y1, y2), -10, where=(np.minimum(y1, y2) > -10), color='gray', alpha=0.3)

# Titik-titik penting
plt.scatter([0, 1, -1, 3], [4, 4, 0, 0], color='black', label='Titik penting')

# Label dan legenda
plt.title('Grafik Ketidaksetaraan')
plt.xlabel('x')
plt.ylabel('y')
plt.axhline(0, color='black', linewidth=0.5, linestyle='--')
plt.axvline(0, color='black', linewidth=0.5, linestyle='--')
plt.legend()
plt.grid(True)

# Tampilkan grafik
plt.show()
